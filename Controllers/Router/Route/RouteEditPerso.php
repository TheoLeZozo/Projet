<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/*
 * Route pour l'édition d'un personnage (perso) protégé
 */
class RouteEditPerso extends ProtectedRoute
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);
    }

    public function get(array $params = []): void
    {
        $id = isset($params['id']) ? (int)$params['id'] : 0;
        if ($id <= 0) {
            $this->controller->index("ID manquant / invalide");
            return;
        }

        $this->controller->displayEditPerso($id);
    }

    public function post(array $params = []): void
    {
        $this->controller->savePerso($params);
    }
}
