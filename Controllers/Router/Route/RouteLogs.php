<?php

namespace Controllers\Router\Route;
<<<<<<< HEAD
use Controllers\MainController;

/**
 * Route to handle user logs actions.
 */
class RouteLogs extends ProtectedRoute
=======

use Controllers\MainController;

class RouteLogs extends Route
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);

    }

    public function get(array $params = []): void
    {
        $this->controller->logs($params);
    }

    public function post(array $params = []): void
    {
        $this->controller->logs($params);
    }

}
