<?php
/*
 * Point d'entrée de l'application
 * Initialisation de l'autoloading et du routeur
 * Auteur : Théo CHATELET
 * Date : 2026-01-21
 * Version : 1.0
 */
session_start();
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';
$loader = new Helpers\Psr4AutoloaderClass();

$loader->register();

// Enregistrement des namespaces
$loader->addNamespace('Helpers', '/Helpers');
$loader->addNamespace('Controllers', '/Controllers');
$loader->addNamespace('League\Plates', '/Vendor/Plates/src');
$loader->addNamespace('Config', '/Config');
$loader->addNamespace('Models', '/Models');
$loader->addNamespace('Services', '/Services');

// Lancement du routeur
$router = new Controllers\Router\Router();
$router->routing();