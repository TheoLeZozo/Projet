<?php

namespace Models;

class OriginDAO extends BasePDODAO
{
<<<<<<< HEAD
    public function countAll(): int
    {
        $stmt = $this->execRequest('SELECT COUNT(*) FROM origin');
        return (int)$stmt->fetchColumn();
    }
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function create(Origin $origin): int
    {
        $sql = "INSERT INTO origin (name, url_img) VALUES (:name, :url_img)";
        $this->execRequest($sql, [
            'name'    => $origin->getName(),
            'url_img' => $origin->getUrlImg(),
        ]);

        return (int)$this->getDB()->lastInsertId();
    }

    public function update(Origin $origin): bool
    {
        if ($origin->getId() === null) {
            return false;
        }

        $sql = "UPDATE origin SET name = :name, url_img = :url_img WHERE id = :id";
        $stmt = $this->execRequest($sql, [
            'id'      => $origin->getId(),
            'name'    => $origin->getName(),
            'url_img' => $origin->getUrlImg(),
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        // sécurité: si utilisé par un personnage, on refuse
        if ($this->isUsed($id)) {
            return false;
        }

        $stmt = $this->execRequest("DELETE FROM origin WHERE id = :id", ['id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public function getAll(): array
    {
        $stmt = $this->execRequest("SELECT * FROM origin ORDER BY name ASC");

        $origins = [];
        foreach ($stmt->fetchAll() as $row) {
            $o = new Origin();
            $o->setId((int)$row['id']);
            $o->setName($row['name']);
            $o->setUrlImg($row['url_img']);
            $origins[] = $o;
        }

        return $origins;
    }

    public function getById(int $id): ?Origin
    {
        $stmt = $this->execRequest("SELECT * FROM origin WHERE id = :id", ['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $o = new Origin();
        $o->setId((int)$row['id']);
        $o->setName($row['name']);
        $o->setUrlImg($row['url_img']);
        return $o;
    }

    public function exists(int $id): bool
    {
        $stmt = $this->execRequest("SELECT id FROM origin WHERE id = :id", ['id' => $id]);
        return $stmt->fetch() !== false;
    }

    public function isUsed(int $id): bool
    {
        $stmt = $this->execRequest(
            "SELECT COUNT(*) AS c FROM personnage WHERE origin_id = :id",
            ['id' => $id]
        );
        $row = $stmt->fetch();
        return ((int)($row['c'] ?? 0)) > 0;
    }
}
