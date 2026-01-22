<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la suppression d'une classe d'unité
 */
class RouteDelUnitClass extends ProtectedRoute
{
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        if (empty($params['id'])) {
            $this->controller->index("ID manquant");
            return;
        }

        $this->controller->deleteUnitClass((int)$params['id']);
    }

    public function post(array $params = []): void {}
}
