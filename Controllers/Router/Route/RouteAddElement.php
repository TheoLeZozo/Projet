<?php

namespace Controllers\Router\Route;
<<<<<<< HEAD
use Controllers\MainController;

/*
 * Classe représentant la route pour ajouter un élément.
 * Elle hérite de ProtectedRoute pour assurer que cette route est protégée.
 */
class RouteAddElement extends ProtectedRoute
=======

use Controllers\MainController;

class RouteAddElement extends Route
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
{
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddElement();
    }

    public function post(array $params = []): void
    {
        $this->controller->addElement($params);
    }
}
