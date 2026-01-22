<?php

namespace Models;
use PDO;

/*faite partie du modèle d'accès aux données (DAO) pour les relations entre utilisateurs et personnages.
Elle fournit des méthodes pour interagir avec la table user_personnage dans la base de données.
*/
class UserPersonnageDAO extends BasePDODAO
{
    public function countForUser(string $userId): int
    {
        $stmt = $this->execRequest(
            'SELECT COUNT(*) FROM user_personnage WHERE user_id = :uid',
            [':uid' => $userId]
        );
        return (int)$stmt->fetchColumn();
    }

    public function getPersoIds(string $userId): array
    {
        $sql = "SELECT personnage_id
                FROM user_personnage
                WHERE user_id = :uid";

        $stmt = $this->execRequest($sql, [':uid' => $userId]);

        // retourne juste une liste d’IDs (int)
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public function hasPerso(string $userId, int $persoId): bool
    {
        $sql = "SELECT 1
                FROM user_personnage
                WHERE user_id = :uid AND personnage_id = :pid
                LIMIT 1";

        $stmt = $this->execRequest($sql, [
            ':uid' => $userId,
            ':pid' => $persoId
        ]);

        return (bool) $stmt->fetchColumn();
    }

    public function add(string $userId, int $persoId): void
    {
        // MySQL : évite les doublons si tu as une clé unique (user_id, personnage_id)
        $sql = "INSERT IGNORE INTO user_personnage (user_id, personnage_id)
                VALUES (:uid, :pid)";

        $this->execRequest($sql, [
            ':uid' => $userId,
            ':pid' => $persoId
        ]);
    }

    public function remove(string $userId, int $persoId): void
    {
        $sql = "DELETE FROM user_personnage
                WHERE user_id = :uid AND personnage_id = :pid";

        $this->execRequest($sql, [
            ':uid' => $userId,
            ':pid' => $persoId
        ]);
    }

    public function toggle(string $userId, int $persoId): bool
    {
        if ($this->hasPerso($userId, $persoId)) {
            $this->remove($userId, $persoId);
            return false; // maintenant retiré
        }

        $this->add($userId, $persoId);
        return true; // maintenant ajouté
    }
}
