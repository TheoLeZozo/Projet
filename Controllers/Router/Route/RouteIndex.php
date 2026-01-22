<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route for the index page
 */
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
