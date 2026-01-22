<?php

namespace Controllers\Router\Route;
<<<<<<< HEAD
use Controllers\MainController;

/**
 * Route pour ajouter une origine.
 * Hérite de ProtectedRoute pour garantir que cette route est sécurisée.
 */
class RouteAddOrigin extends ProtectedRoute
=======

use Controllers\MainController;

class RouteAddOrigin extends Route
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
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
