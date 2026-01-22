<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Class RouteToggleCollection
 * @package Controllers\Router\Route
 */
class RouteToggleCollection extends ProtectedRoute
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);
    }

    public function get(array $params = []): void
    {
        // On évite le toggle via GET. On renvoie vers l'accueil.
        header('Location: index.php?action=home');
        exit;
    }

    public function post(array $params = []): void
    {
        $id = (int)($_POST['id'] ?? 0);
        $this->controller->toggleCollection($id);
    }
}
