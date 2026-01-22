<?php

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la suppression d'un personnage
 */
class RouteDelPerso extends ProtectedRoute
{
    public function __construct(string $actionKey, MainController $controller)
    {
        parent::__construct($actionKey, $controller);

    }

    // Suppression via GET (TP simple)
    public function get(array $params = []): void
    {
        if (empty($params['id'])) {
            $this->controller->index("ID manquant");
            return;
        }

        $this->controller->deletePerso($params['id']);
    }

    // Obligatoire car Route est abstraite
    public function post(array $params = []): void
    {
        // volontairement vide
    }
}
