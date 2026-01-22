<?php

namespace Controllers\Router\Route;
<<<<<<< HEAD
use Controllers\MainController;

/**
 * Route for the index page
 */
=======

use Controllers\MainController;

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
class RouteIndex extends Route
{
    public function __construct(MainController $controller)
    {
        parent::__construct('home', $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->home();
    }

    public function post(array $params = []): void
    {
        $this->controller->home();
    }

}
