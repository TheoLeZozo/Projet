<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route for login actions
 */
class RouteLogin extends Route
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);

    }

    public function get(array $params = []): void
    {
        $this->controller->login();
    }

    public function post(array $params = []): void
    {
        $this->controller->login();
    }
}

 