<?php

namespace Config;
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
            self::$param = parse_ini_file($cheminFichier, true);
        }
        return self::$param;
    }
}
