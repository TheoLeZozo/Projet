<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour ajouter une origine.
 * Hérite de ProtectedRoute pour garantir que cette route est sécurisée.
 */
class RouteAddOrigin extends ProtectedRoute
{
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddOrigin();
    }

    public function post(array $params = []): void
    {
        $this->controller->addOrigin($params);
    }

}
