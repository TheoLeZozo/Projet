<?php

namespace Models;

/**
 * Class ElementDAO
 *
 * Acces à la table element
 */
class ElementDAO extends BasePDODAO
{
    public function countAll(): int
    {
        $stmt = $this->execRequest('SELECT COUNT(*) FROM element');
        return (int)$stmt->fetchColumn();
    }

    public function create(Element $element): int
    {
        $sql = "INSERT INTO element (name, url_img) VALUES (:name, :url_img)";
        $this->execRequest($sql, [
            'name'    => $element->getName(),
            'url_img' => $element->getUrlImg(),
        ]);

        return (int)$this->getDB()->lastInsertId();
    }

    public function update(Element $element): bool
    {
        if ($element->getId() === null) {
            return false;
        }

        $sql = "UPDATE element SET name = :name, url_img = :url_img WHERE id = :id";
        $stmt = $this->execRequest($sql, [
            'id'      => $element->getId(),
            'name'    => $element->getName(),
            'url_img' => $element->getUrlImg(),
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        // Si l'élément est lié à des persos, on supprime les liens puis l'élément
        $db = $this->getDB();

        try {
            $db->beginTransaction();

            $this->execRequest(
                "DELETE FROM personnage_element WHERE element_id = :id",
                ['id' => $id]
            );

            $stmt = $this->execRequest(
                "DELETE FROM element WHERE id = :id",
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
        $stmt = $this->execRequest("SELECT * FROM element ORDER BY name ASC");

        $elements = [];
        foreach ($stmt->fetchAll() as $row) {
            $e = new Element();
            $e->setId((int)$row['id']);
            $e->setName($row['name']);
            $e->setUrlImg($row['url_img']);
            $elements[] = $e;
        }

        return $elements;
    }

    public function getById(int $id): ?Element
    {
        $stmt = $this->execRequest("SELECT * FROM element WHERE id = :id", ['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $e = new Element();
        $e->setId((int)$row['id']);
        $e->setName($row['name']);
        $e->setUrlImg($row['url_img']);
        return $e;
    }

    public function getByPersonnageId(int $personnageId): array
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

    public function isUsed(int $id): bool
    {
        $stmt = $this->execRequest(
            "SELECT COUNT(*) AS c FROM personnage_element WHERE element_id = :id",
            ['id' => $id]
        );
        $row = $stmt->fetch();
        return ((int)($row['c'] ?? 0)) > 0;
    }
}
