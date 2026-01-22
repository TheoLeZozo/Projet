<?php

namespace Controllers;

use Models\Personnage;
use Models\PersonnageDAO;

<<<<<<< HEAD
/*
 * Contrôleur pour la gestion des personnages
 */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
class PersoController
{
    /**
     * Affichage du formulaire vide (création)
     */
    public function displayAddPerso(?string $message = null): void
    {
        echo $this->render('add-perso', [
            'title' => 'Ajouter un personnage',
            'message' => $message
        ]);
    }

    /**
     * Affichage du formulaire pré-rempli (édition)
     */
    public function displayEditPerso(string $id): void
    {
        $dao = new PersonnageDAO();
        $perso = $dao->getByID($id);

        if (!$perso) {
            $this->displayAddPerso("Personnage introuvable");
            return;
        }

        echo $this->render('add-perso', [
            'title' => 'Modifier un personnage',
            'perso' => $perso
        ]);
    }

    /**
     * Création d'un personnage
     */
    public function addPerso(array $data): void
    {
        $data['id'] = uniqid();

        $perso = new Personnage($data);
        $dao = new PersonnageDAO();

        $dao->createPersonnage($perso);

        (new MainController())->index("Personnage ajouté avec succès");
    }

    /**
     * Mise à jour d'un personnage
     */
    public function editPersoAndIndex(array $data): void
    {
        if (empty($data['id'])) {
            throw new \Exception("ID manquant");
        }

        $perso = new Personnage($data);
        $dao = new PersonnageDAO();

        $dao->updatePerso($perso);

        (new MainController())->index("Personnage modifié avec succès");
    }

    /**
     * Suppression
     */
    public function deletePersoAndIndex(?string $id): void
    {
        $dao = new PersonnageDAO();

        if ($id && $dao->deletePerso($id)) {
            (new MainController())->index("Suppression réussie");
        } else {
            (new MainController())->index("Erreur lors de la suppression");
        }
    }

    /**
     * Petit helper pour rendre les vues (Plates)
     */
    private function render(string $view, array $params = []): string
    {
        $engine = new \League\Plates\Engine(__DIR__ . '/../Views');
        return $engine->render($view, $params);
    }
}
