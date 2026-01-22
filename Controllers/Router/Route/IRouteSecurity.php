<?php

namespace Controllers\Router\Route;

interface IRouteSecurity
{
    public function isRouteProtected(): bool;

    /**
     * Doit lever une exception si la route est protégée et que l'utilisateur
     * n'est pas autorisé.
     */
    public function protectRoute(): void;
}
