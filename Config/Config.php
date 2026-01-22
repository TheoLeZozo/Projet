<?php

namespace Config;
<<<<<<< HEAD
=======

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
use Exception;

class Config
{
    private static ?array $param = null;

    public static function get(string $nom, $valeurParDefaut = null)
    {
        $param = self::getParameter();
        return $param[$nom] ?? $valeurParDefaut;
    }

    private static function getParameter(): array
    {
        if (self::$param === null) {
            $cheminFichier = __DIR__ . '/prod.ini';

            if (!file_exists($cheminFichier)) {
                $cheminFichier = __DIR__ . '/dev.ini';
            }

            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
<<<<<<< HEAD
            self::$param = parse_ini_file($cheminFichier, true);
        }
=======

            self::$param = parse_ini_file($cheminFichier, true);
        }

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
        return self::$param;
    }
}
