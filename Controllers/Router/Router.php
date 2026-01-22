<?php

namespace Controllers\Router;

use Controllers\Router\Route\Route;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteAddOrigin;
use Controllers\Router\Route\RouteAddUnitClass;
use Controllers\Router\Route\RouteAddElement;
use Controllers\Router\Route\RouteShowPerso;
use Controllers\Router\Route\RouteLogout;
use Controllers\Router\Route\RouteEditOrigin;
use Controllers\Router\Route\RouteDelOrigin;    
use Controllers\Router\Route\RouteDelUnitClass;
use Controllers\Router\Route\RouteDelElement;
use Controllers\Router\Route\RouteEditElement;
use Controllers\Router\Route\RouteEditUnitClass;
use Controllers\Router\Route\RouteToggleCollection;
use Controllers\MainController;
use Controllers\PersoController;

/*
 * Gestionnaire de routes
 * Permet de définir les routes et d'effectuer le routage
 * en fonction des requêtes entrantes
 */

class Router
{
    protected array $routeList = [];
    protected array $ctrlList = [];
    protected string $actionKey;

    /*constructeur*/

    public function __construct(string $actionKey = 'action')
    {
        $this->actionKey = $actionKey;
        $this->createControllerList();
        $this->createRouteList();
    }

    /*initialisation des contrôleurs et des routes*/

    protected function createControllerList(): void
    {
        $this->ctrlList = [
            'main'  => new MainController(),
        ];
    }

    /*initialisation des routes*/

    private function createRouteList(): void
    {
        $main = $this->ctrlList['main'];

        $this->routeList = [

            // Accueil
            'home' => new \Controllers\Router\Route\RouteIndex($main),


            // Ajouter un personnage
            'add-perso' => new \Controllers\Router\Route\RouteAddPerso(
                'add-perso',
                $main
            ),

            // Sauvegarde (ADD + EDIT)
            'save-perso' => new \Controllers\Router\Route\RouteAddPerso(
                'save-perso',
                $main
            ),

            // Modifier un personnage
            'edit-perso' => new \Controllers\Router\Route\RouteEditPerso(
                'edit-perso',
                $main
            ),

            // Supprimer un personnage
            'del-perso' => new \Controllers\Router\Route\RouteDelPerso(
                'del-perso',
                $main
            ),

            // Pages annexes
            'logs' => new \Controllers\Router\Route\RouteLogs(
                'logs',
                $main
            ),

            // Authentification
            'login' => new \Controllers\Router\Route\RouteLogin(
                'login',
                $main
            ),

            // Déconnexion
            'logout' => new \Controllers\Router\Route\RouteLogout(
                'logout',
                $main
            ),

            // Inscription
            'register' => new \Controllers\Router\Route\RouteRegister(
                'register',
                $main
            ),

            // Page protégée
            'protected' => new \Controllers\Router\Route\RouteProtectedPage(
                'protected',
                $main
            ),

            // Gérer la collection
            'toggle-collection' => new \Controllers\Router\Route\RouteToggleCollection(
                'toggle-collection',
                $main
            ),

            // Ma collection
            'my-collection' => new \Controllers\Router\Route\RouteMyCollection(
                'my-collection',
                $main
            ),

            // Ajouter une origine
            'add-origin' => new \Controllers\Router\Route\RouteAddOrigin(
                'add-origin',
                $main
            ),

            // Ajouter une classe d'unité
            'add-unitclass' => new \Controllers\Router\Route\RouteAddUnitClass(
                'add-unitclass',
                $main
            ),

            // Ajouter un élément
            'add-element' => new \Controllers\Router\Route\RouteAddElement(
                'add-element',
                $main
            ),
            // Fiche personnage
            'show-perso' => new \Controllers\Router\Route\RouteShowPerso(
                'show-perso',
                $main
            ),

            // Édition et suppression des origines, classes d'unités et éléments
            'edit-origin' => new \Controllers\Router\Route\RouteEditOrigin(
                'edit-origin',
                $main
            ),

            // Suppression d'une origine
            'del-origin' => new \Controllers\Router\Route\RouteDelOrigin(
                'del-origin',
                $main
            ),   
            
            // Suppression d'une classe d'unité
            'del-unitclass' => new \Controllers\Router\Route\RouteDelUnitClass(
                'del-unitclass',
                $main
            ),

            // Suppression d'un élément
            'del-element' => new \Controllers\Router\Route\RouteDelElement(
                'del-element',
                $main
            ),

            // Édition d'un élément
            'edit-element' => new \Controllers\Router\Route\RouteEditElement(
                'edit-element',
                $main
            ),

            // Édition d'une classe d'unité
            'edit-unitclass' => new \Controllers\Router\Route\RouteEditUnitClass(
                'edit-unitclass',
                $main
            ),
        ];
    }


    /*routage*/
    public function routing(): void
    {
        $action = $_GET[$this->actionKey] ?? 'home';
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routeList[$action])) {
            http_response_code(404);
            $this->ctrlList['main']->error(404, 'Page non trouvée');
            return;
        }

        $route = $this->routeList[$action];
        try {
            $route->protectRoute();
        } catch (\Controllers\Router\Route\RouteSecurityException $e) {
            $msg = urlencode($e->getMessage());
            header("Location: index.php?action=login&error={$msg}");
            exit;
        }

        if ($method === 'POST') {
            $route->action($_POST, 'POST');
        } else {
            $route->action($_GET, 'GET');
        }
    }
}
