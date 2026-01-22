<?php

namespace Services;

use Models\Personnage;
use Models\PersonnageDAO;

<<<<<<< HEAD
/**
 * Service pour gérer les opérations liées aux personnages
 */
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
class PersonnageService
{
    private PersonnageDAO $personnageDAO;

    public function __construct()
    {
        $this->personnageDAO = new PersonnageDAO();
    }

    /**
     * Récupère tous les personnages (version SIMPLE et STABLE)
     */
    public function getAll(): array
    {
        $personnages = [];

        $rows = $this->personnageDAO->getAll();

        foreach ($rows as $row) {
            // $row est déjà un Personnage hydraté par le DAO
            $personnages[] = $row;
        }

        return $personnages;
    }

    /**
     * Récupère un personnage par ID
     */
    public function getById(string $id): ?Personnage
    {
        return $this->personnageDAO->getById($id);
    }
}
