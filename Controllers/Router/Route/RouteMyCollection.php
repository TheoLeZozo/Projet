<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la page "Ma collection"
 */
class RouteMyCollection extends ProtectedRoute
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->myCollection($params['message'] ?? null);
    }

    public function post(array $params = []): void
    {
        // pas de formulaire ici, on fait simple
        $this->get($params);
    }
}
