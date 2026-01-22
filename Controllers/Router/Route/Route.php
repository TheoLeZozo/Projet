<?php

namespace Controllers\Router\Route;
/*
 * Classe abstraite représentant une route dans le système de routage.
 * Elle définit les méthodes de base pour gérer les requêtes GET et POST,
 * ainsi que les mécanismes de sécurité des routes.
 */
abstract class Route implements IRouteSecurity
{
    protected string $actionKey;
    protected $controller;

    public function __construct(string $actionKey, $controller)
    {
        $this->actionKey = $actionKey;
        $this->controller = $controller;
    }

    public function action(array $params = [], string $method = 'GET'): void
    {
        if ($method === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    public function isRouteProtected(): bool
    {
        return false;
    }

    public function protectRoute(): void
    {
        // Route "normale" : rien à protéger.
    }

    abstract public function get(array $params = []): void;
    abstract public function post(array $params = []): void;
}
