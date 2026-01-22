<?php

namespace Models;

/*
 * classe DAO pour la gestion des classes d'unités
 */
class UnitClassDAO extends BasePDODAO
{
    public function countAll(): int
    {
        $stmt = $this->execRequest('SELECT COUNT(*) FROM unitclass');
        return (int)$stmt->fetchColumn();
    }

    public function create(UnitClass $unitClass): int
    {
        $sql = "INSERT INTO unitclass (name, url_img) VALUES (:name, :url_img)";
        $this->execRequest($sql, [
            'name'    => $unitClass->getName(),
            'url_img' => $unitClass->getUrlImg(),
        ]);

        return (int)$this->getDB()->lastInsertId();
    }

    public function update(UnitClass $unitClass): bool
    {
        if ($unitClass->getId() === null) {
            return false;
        }

        $sql = "UPDATE unitclass SET name = :name, url_img = :url_img WHERE id = :id";
        $stmt = $this->execRequest($sql, [
            'id'      => $unitClass->getId(),
            'name'    => $unitClass->getName(),
            'url_img' => $unitClass->getUrlImg(),
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        if ($this->isUsed($id)) {
            return false;
        }

        $stmt = $this->execRequest("DELETE FROM unitclass WHERE id = :id", ['id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public function getAll(): array
    {
        $stmt = $this->execRequest("SELECT * FROM unitclass ORDER BY name ASC");

        $unitClasses = [];
        foreach ($stmt->fetchAll() as $row) {
            $u = new UnitClass();
            $u->setId((int)$row['id']);
            $u->setName($row['name']);
            $u->setUrlImg($row['url_img']);
            $unitClasses[] = $u;
        }

        return $unitClasses;
    }

    public function getById(int $id): ?UnitClass
    {
        $stmt = $this->execRequest("SELECT * FROM unitclass WHERE id = :id", ['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $u = new UnitClass();
        $u->setId((int)$row['id']);
        $u->setName($row['name']);
        $u->setUrlImg($row['url_img']);
        return $u;
    }

    public function isUsed(int $id): bool
    {
        $stmt = $this->execRequest(
            "SELECT COUNT(*) AS c FROM personnage WHERE unitclass_id = :id",
            ['id' => $id]
        );
        $row = $stmt->fetch();
        return ((int)($row['c'] ?? 0)) > 0;
    }
}
