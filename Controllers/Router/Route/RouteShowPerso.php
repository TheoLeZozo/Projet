<?php

namespace Controllers\Router\Route;
<<<<<<< HEAD
use Controllers\MainController;

/**
 * Class RouteShowPerso
 * @package Controllers\Router\Route
 */
=======

use Controllers\MainController;

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
class RouteShowPerso extends Route
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);
    }

    public function get($params = []): void
    {
        $id = isset($params['id']) ? (int)$params['id'] : 0;
        if ($id <= 0) {
            $this->controller->home("ID du personnage manquant.");
            return;
        }

        $this->controller->displayShowPerso($id);
    }

    public function post($params = []): void
    {
        // Pas de POST ici.
        $this->controller->home();
    }
}
