<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * RouteRegister handles the registration routes.
 */
class RouteRegister extends Route
{
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->registerForm();
    }

    public function post(array $params = []): void
    {
        $this->controller->register($_POST);
    }
}
