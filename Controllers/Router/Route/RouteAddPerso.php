<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour l'ajout d'un personnage
 */
class RouteAddPerso extends ProtectedRoute
{
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddPerso();
    }

    public function post(array $params = []): void
    {
        $this->controller->savePerso($params);
    }
}
