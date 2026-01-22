<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route to handle user login actions.
 */
class RouteLogout extends Route
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->logout();
    }

    public function post(array $params = []): void
    {
        $this->controller->logout();
    }
}
