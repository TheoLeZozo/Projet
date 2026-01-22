<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour l'ajout d'une classe d'unité
 */
class RouteAddUnitClass extends ProtectedRoute
{
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddUnitClass();
    }

    public function post(array $params = []): void
    {
        $this->controller->addUnitClass($params);
    }
}
