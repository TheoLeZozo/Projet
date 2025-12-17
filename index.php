<?php
 
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';
 
$loader = new Helpers\Psr4AutoloaderClass();
$loader->register();
 
$loader->addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('\League\Plates', '/Vendor/Plates/src');
 
$templates = new League\Plates\Engine(__DIR__ . '/Views');
 
echo $templates->render('home', ['gameName' => 'Jeu à choisir']);