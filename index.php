<?php

// Charger la configuration et le routeur
require_once __DIR__ . '/src/config/config.php';
require_once __DIR__ . '/src/Controllers/Router.php';

// Utiliser le routeur pour gérer la requête
use Src\Controllers\Router;
$router = new Router();
$router->handleRequest(); // Gérer la requête
