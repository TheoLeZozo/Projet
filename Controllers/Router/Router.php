<?php

namespace Controllers\Router;

use Controllers\Router\Route\Route;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
<<<<<<< HEAD
=======
// use Controllers\Router\Route\RouteAddPersoElement;
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteAddOrigin;
use Controllers\Router\Route\RouteAddUnitClass;
use Controllers\Router\Route\RouteAddElement;
use Controllers\Router\Route\RouteShowPerso;
<<<<<<< HEAD
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

=======

use Controllers\MainController;
use Controllers\PersoController;

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
class Router
{
    protected array $routeList = [];
    protected array $ctrlList = [];
    protected string $actionKey;

<<<<<<< HEAD
    /*constructeur*/

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function __construct(string $actionKey = 'action')
    {
        $this->actionKey = $actionKey;
        $this->createControllerList();
        $this->createRouteList();
    }

<<<<<<< HEAD
    /*initialisation des contrôleurs et des routes*/

=======
    /* ===============================
       CONTROLLERS
       =============================== */
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    protected function createControllerList(): void
    {
        $this->ctrlList = [
            'main'  => new MainController(),
        ];
    }

<<<<<<< HEAD
    /*initialisation des routes*/

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
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

<<<<<<< HEAD
=======
            /* Ajouter un elément à un personnage
            'add-perso-element' => new \Controllers\Router\Route\RouteAddPersoElement(
                'add-perso-element',
                $main
            ),
            */

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
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

<<<<<<< HEAD
            // Authentification
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'login' => new \Controllers\Router\Route\RouteLogin(
                'login',
                $main
            ),

<<<<<<< HEAD
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
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'add-origin' => new \Controllers\Router\Route\RouteAddOrigin(
                'add-origin',
                $main
            ),

<<<<<<< HEAD
            // Ajouter une classe d'unité
=======
            
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'add-unitclass' => new \Controllers\Router\Route\RouteAddUnitClass(
                'add-unitclass',
                $main
            ),

<<<<<<< HEAD
            // Ajouter un élément
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'add-element' => new \Controllers\Router\Route\RouteAddElement(
                'add-element',
                $main
            ),
<<<<<<< HEAD

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            // Fiche personnage
            'show-perso' => new \Controllers\Router\Route\RouteShowPerso(
                'show-perso',
                $main
            ),
<<<<<<< HEAD

            // Édition et suppression des origines, classes d'unités et éléments
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'edit-origin' => new \Controllers\Router\Route\RouteEditOrigin(
                'edit-origin',
                $main
            ),
<<<<<<< HEAD

            // Suppression d'une origine
            'del-origin' => new \Controllers\Router\Route\RouteDelOrigin(
                'del-origin',
                $main
            ),   
            
            // Suppression d'une classe d'unité
=======
            'del-origin' => new \Controllers\Router\Route\RouteDelOrigin(
                'del-origin',
                $main
            ),     
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'del-unitclass' => new \Controllers\Router\Route\RouteDelUnitClass(
                'del-unitclass',
                $main
            ),
<<<<<<< HEAD

            // Suppression d'un élément
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'del-element' => new \Controllers\Router\Route\RouteDelElement(
                'del-element',
                $main
            ),
<<<<<<< HEAD

            // Édition d'un élément
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'edit-element' => new \Controllers\Router\Route\RouteEditElement(
                'edit-element',
                $main
            ),
<<<<<<< HEAD

            // Édition d'une classe d'unité
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            'edit-unitclass' => new \Controllers\Router\Route\RouteEditUnitClass(
                'edit-unitclass',
                $main
            ),
<<<<<<< HEAD
=======

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
        ];
    }


<<<<<<< HEAD
    /*routage*/
=======

    /* ===============================
       ROUTING
       =============================== */
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function routing(): void
    {
        $action = $_GET[$this->actionKey] ?? 'home';
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routeList[$action])) {
            http_response_code(404);
<<<<<<< HEAD
            $this->ctrlList['main']->error(404, 'Page non trouvée');
=======
            echo 'Page non trouvée';
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
            return;
        }

        $route = $this->routeList[$action];
<<<<<<< HEAD
        try {
            $route->protectRoute();
        } catch (\Controllers\Router\Route\RouteSecurityException $e) {
            $msg = urlencode($e->getMessage());
            header("Location: index.php?action=login&error={$msg}");
            exit;
        }
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95

        if ($method === 'POST') {
            $route->action($_POST, 'POST');
        } else {
            $route->action($_GET, 'GET');
        }
    }
}
