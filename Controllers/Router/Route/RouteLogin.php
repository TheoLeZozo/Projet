<?php

namespace Controllers\Router\Route;
<<<<<<< HEAD
use Controllers\MainController;

/**
 * Route for login actions
 */
=======

use Controllers\MainController;

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
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

 