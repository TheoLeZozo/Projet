<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Class RouteShowPerso
 * @package Controllers\Router\Route
 */
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
