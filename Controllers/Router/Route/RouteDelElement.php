<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la suppression d'un élément
 */
class RouteDelElement extends ProtectedRoute
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

        $this->controller->deleteElement((int)$params['id']);
    }

    public function post(array $params = []): void {}
}
