<?php
namespace Models;

/*
* Classe user qui représente un utilisateur dans le système.
* Elle inclut des propriétés pour l'identifiant, le nom d'utilisateur et le hash du mot de passe.
* Le constructeur accepte un tableau de données pour initialiser les propriétés.
*/
class User
{
    private string $id;
    private string $username;
    private string $password_hash;

    public function __construct(array $data = [])
    {
        if ($data) {
            $this->id = (string)$data['id'];
            $this->username = $data['username'];
            $this->password_hash = $data['password_hash'] ?? $data['hash_pwd'] ?? '';
        }
    }

    public function getId(): string { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getPasswordHash(): string { return $this->password_hash; }
}
