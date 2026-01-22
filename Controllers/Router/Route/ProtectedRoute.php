<?php
namespace Controllers\Router\Route;

/*
 * Classe abstraite pour les routes protégées (nécessitant une authentification)
 */
abstract class ProtectedRoute extends Route
{
    public function isRouteProtected(): bool
    {
        return true;
    }

    public function protectRoute(): void
    {
        // Le service gère aussi le timeout
        if (!\Services\AuthService::isLogged()) {
            throw new RouteSecurityException('Connexion requise.');
        }
    }
}
