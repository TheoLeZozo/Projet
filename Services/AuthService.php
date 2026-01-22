<?php
namespace Services;

use Models\UserDAO;

/**
 * Service pour gérer l'authentification des utilisateurs
 */
class AuthService
{
    // Durée de validité d'une session (en secondes).
    private const SESSION_LIFETIME = 1800; // 30 minutes

    public static function login(string $username, string $password): bool
    {
        $dao = new UserDAO();
        $user = $dao->getByUsername($username);

        if (!$user) return false;
        if (!password_verify($password, $user->getPasswordHash())) return false;

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername()
        ];

        // timeout de session (TP06)
        $_SESSION['timeout'] = time() + self::SESSION_LIFETIME;

        // bonus sécurité: évite la fixation de session
        session_regenerate_id(true);

        return true;
    }

    public static function logout(): void
    {
        unset($_SESSION['user'], $_SESSION['timeout']);
    }

    public static function isLogged(): bool
    {
        if (!isset($_SESSION['user'])) {
            return false;
        }

        $timeout = (int)($_SESSION['timeout'] ?? 0);
        if ($timeout <= 0 || time() > $timeout) {
            // session expirée
            self::logout();
            return false;
        }

        // Sliding expiration: si l'utilisateur est actif, on prolonge.
        $_SESSION['timeout'] = time() + self::SESSION_LIFETIME;
        return true;
    }
}
