<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route for a protected page that requires user authentication.
 */
class RouteProtectedPage extends ProtectedRoute
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->protectedPage();
    }

    public function post(array $params = []): void
    {
        $this->controller->protectedPage();
    }
}
