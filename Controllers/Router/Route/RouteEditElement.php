<?php
<<<<<<< HEAD

namespace Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour l'édition d'un élément existant.
 */
class RouteEditElement extends ProtectedRoute
=======
namespace Controllers\Router\Route;

use Controllers\MainController;

class RouteEditElement extends Route
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
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

        $this->controller->displayEditElement((int)$params['id']);
    }

    public function post(array $params = []): void
    {
        $this->controller->updateElement($params);
    }
}
