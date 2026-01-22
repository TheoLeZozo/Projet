<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route to handle user logs actions.
 */
class RouteLogs extends ProtectedRoute
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
