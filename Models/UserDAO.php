<?php
namespace Models;

/*faite partie du modèle d'accès aux données (DAO) pour les utilisateurs.
Elle fournit des méthodes pour interagir avec la table des utilisateurs dans la base de données,
en tenant compte des variations possibles dans la structure de la table users.
*/
class UserDAO extends BasePDODAO
{
    public function getByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM users WHERE username = :u LIMIT 1";
        $stmt = $this->execRequest($sql, [':u' => $username]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $row ? new User($row) : null;
    }

    public function existsByUsername(string $username): bool
    {
        $stmt = $this->execRequest(
            "SELECT 1 FROM users WHERE username = :u LIMIT 1",
            [':u' => $username]
        );
        return (bool)$stmt->fetchColumn();
    }

    public function create(string $username, string $hash): void
    {
        $col = $this->detectHashColumn();

        $sql = "INSERT INTO users (username, $col) VALUES (:u, :h)";
        $this->execRequest($sql, [
            ':u' => $username,
            ':h' => $hash
        ]);
    }

    private function detectHashColumn(): string
    {
        $stmt = $this->execRequest("SHOW COLUMNS FROM users");
        $cols = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $names = array_column($cols, 'Field');

        return in_array('hash_pwd', $names, true) ? 'hash_pwd' : 'password_hash';
    }
}
