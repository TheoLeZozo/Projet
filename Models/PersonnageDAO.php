<?php

namespace Models;

<<<<<<< HEAD
/*
 * Classe d'accès aux données pour les personnages
 */
class PersonnageDAO extends BasePDODAO
{
    public function countAll(): int
    {
        $stmt = $this->execRequest('SELECT COUNT(*) FROM personnage');
        return (int)$stmt->fetchColumn();
    }
=======
class PersonnageDAO extends BasePDODAO
{
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function create(Personnage $perso): int
    {
        $sql = "
            INSERT INTO personnage (name, origin_id, unitclass_id, rarity, image)
            VALUES (:name, :origin, :unitclass, :rarity, :image)
        ";

        $this->execRequest($sql, [
            'name'      => $perso->getName(),
            'origin'    => $perso->getOriginId(),
            'unitclass' => $perso->getUnitClassId(),
            'rarity'    => $perso->getRarity(),
            'image'     => $perso->getImage(),
        ]);

        return (int)$this->getDB()->lastInsertId();
    }

    public function update(Personnage $p): bool
    {
        if ($p->getId() === null) {
            return false;
        }

        $sql = "
            UPDATE personnage
            SET name = :name,
                origin_id = :origin,
                unitclass_id = :unitclass,
                rarity = :rarity,
                image = :image
            WHERE id = :id
        ";

        $stmt = $this->execRequest($sql, [
            'id'        => $p->getId(),
            'name'      => $p->getName(),
            'origin'    => $p->getOriginId(),
            'unitclass' => $p->getUnitClassId(),
            'rarity'    => $p->getRarity(),
            'image'     => $p->getImage(),
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $db = $this->getDB();

        try {
            $db->beginTransaction();

            // supprime liens N-N
            $this->execRequest(
                "DELETE FROM personnage_element WHERE personnage_id = :id",
                ['id' => $id]
            );

            // supprime perso
            $stmt = $this->execRequest(
                "DELETE FROM personnage WHERE id = :id",
                ['id' => $id]
            );

            $db->commit();
            return $stmt->rowCount() > 0;
        } catch (\Throwable $e) {
            if ($db->inTransaction()) $db->rollBack();
            return false;
        }
    }

    public function getAll(): array
    {
        $stmt = $this->execRequest("SELECT * FROM personnage ORDER BY id DESC");

        $list = [];
        foreach ($stmt->fetchAll() as $row) {
            $p = $this->hydrate($row);
            $list[] = $p;
        }

        return $list;
    }

    public function getById(int $id): ?Personnage
    {
        $stmt = $this->execRequest("SELECT * FROM personnage WHERE id = :id", ['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $p = $this->hydrate($row);

        // charge les éléments N-N
        $p->setElements($this->getElementsByPersonnage($id));

        return $p;
    }

    public function setElements(int $personnageId, array $elementIds): void
    {
        $db = $this->getDB();

        // nettoyage des ids (unique + int)
        $clean = [];
        foreach ($elementIds as $eid) {
            $eid = (int)$eid;
            if ($eid > 0) $clean[$eid] = true;
        }
        $elementIds = array_keys($clean);

        try {
            $db->beginTransaction();

            $this->execRequest(
                "DELETE FROM personnage_element WHERE personnage_id = :pid",
                ['pid' => $personnageId]
            );

            if (!empty($elementIds)) {
                $sql = "INSERT INTO personnage_element (personnage_id, element_id) VALUES (:pid, :eid)";
                foreach ($elementIds as $eid) {
                    $this->execRequest($sql, ['pid' => $personnageId, 'eid' => $eid]);
                }
            }

            $db->commit();
        } catch (\Throwable $e) {
            if ($db->inTransaction()) $db->rollBack();
            throw $e;
        }
    }

    public function getElementsByPersonnage(int $personnageId): array
    {
        $sql = "
            SELECT e.*
            FROM element e
            JOIN personnage_element pe ON pe.element_id = e.id
            WHERE pe.personnage_id = :pid
            ORDER BY e.name ASC
        ";

        $stmt = $this->execRequest($sql, ['pid' => $personnageId]);

        $elements = [];
        while ($row = $stmt->fetch()) {
            $e = new Element();
            $e->setId((int)$row['id']);
            $e->setName($row['name']);
            $e->setUrlImg($row['url_img']);
            $elements[] = $e;
        }

        return $elements;
    }

<<<<<<< HEAD
    public function getElementIdsByPersonnage(int $personnageId): array
    {
        $sql = "
            SELECT element_id
            FROM personnage_element
            WHERE personnage_id = :pid
        ";

        $stmt = $this->execRequest($sql, ['pid' => $personnageId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }


    public function getElementIdByPersoId(int $persoId): array
    {
        $sql = "
            SELECT element_id
            FROM personnage_element
            WHERE personnage_id = :id
        ";

        $stmt = $this->execRequest($sql, ['id' => $persoId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }


=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    private function hydrate(array $data): Personnage
    {
        $p = new Personnage();
        $p->setId($data['id']);
        $p->setName($data['name'] ?? '');
        $p->setOriginId(isset($data['origin_id']) ? (int)$data['origin_id'] : null);
        $p->setUnitClassId(isset($data['unitclass_id']) ? (int)$data['unitclass_id'] : null);
        $p->setRarity(isset($data['rarity']) ? (int)$data['rarity'] : 0);
        $p->setImage($data['image'] ?? null);
        return $p;
    }
}
