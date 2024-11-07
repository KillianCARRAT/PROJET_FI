<?php

// Inclure les fichiers de configuration et les classes nécessaires
require_once __DIR__ . '/src/config/config.php';  // Chemin vers config.php
require_once __DIR__ . '/src/Controllers/Router.php';  // Chemin vers Router.php

// Utiliser le namespace pour le routeur
use Src\Controllers\Router;

// Créer une instance du routeur
$router = new Router();

// Gérer la requête
$router->handleRequest();
