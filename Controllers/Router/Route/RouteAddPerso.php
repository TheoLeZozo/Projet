<?php

namespace Controllers\Router\Route;
<<<<<<< HEAD
use Controllers\MainController;

/**
 * Route pour l'ajout d'un personnage
 */
class RouteAddPerso extends ProtectedRoute
=======

use Controllers\MainController;

class RouteAddPerso extends Route
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
{
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddPerso();
    }

    public function post(array $params = []): void
    {
        $this->controller->savePerso($params);
    }
}
