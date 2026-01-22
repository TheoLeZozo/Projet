<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour l'édition d'une origine
 */
class RouteEditOrigin extends ProtectedRoute
{
    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        if (empty($params['id'])) {
            $this->controller->index("ID manquant");
            return;
        }

        $this->controller->displayEditOrigin((int)$params['id']);
    }

    public function post(array $params = []): void
    {
        $this->controller->updateOrigin($params);
    }
}
