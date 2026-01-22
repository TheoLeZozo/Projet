<?php

namespace Models;
use PDO;
use PDOException;
use Config\Config;

<<<<<<< HEAD
/**
 * Classe de base pour les DAO utilisant PDO
 * Fournit des méthodes pour se connecter à la base de données et exécuter des requêtes SQL
 * @package Models
 */
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
abstract class BasePDODAO
{
    private static ?PDO $db = null;

<<<<<<< HEAD
    /* Obtient une instance PDO pour la connexion à la base de données
     * @return PDO L'instance PDO
     * @throws PDOException Si la connexion échoue
     */
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    protected function getDB(): PDO
    {
        if (self::$db === null) {
            try {
                $dbConfig = Config::get('DB');

                self::$db = new PDO(
                    $dbConfig['dsn'],
                    $dbConfig['user'],
                    $dbConfig['pass'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                throw new PDOException(
                    'Erreur de connexion à la base de données : ' . $e->getMessage()
                );
            }
        }
        return self::$db;
    }

<<<<<<< HEAD
    /* Exécute une requête SQL avec des paramètres optionnels
     * @param string $sql La requête SQL à exécuter
     * @param array|null $params Les paramètres pour la requête SQL
     * @return PDOStatement Le résultat de la requête préparée
     * @throws PDOException Si l'exécution de la requête échoue
     */

=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    protected function execRequest(string $sql, array $params = null)
    {
        $stmt = $this->getDB()->prepare($sql);

        if ($params !== null) {
            $stmt->execute($params);
        } else {
            $stmt->execute();
        }
        return $stmt;
    }
}
