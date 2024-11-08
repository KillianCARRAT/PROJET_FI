<?php

// Définir la constante du chemin de base du projet (la racine de votre projet)
define('BASE_PATH', dirname(__DIR__, 2)); // Déplace BASE_PATH à la racine du projet


// Définir les chemins absolus
define('PUBLIC_PATH', BASE_PATH . '/public');
define('SRC_PATH', BASE_PATH . '/src');
define('VIEWS_PATH', SRC_PATH . '/Views');
define('CONTROLLERS_PATH', SRC_PATH . '/Controllers');
define('ASSETS_PATH', PUBLIC_PATH . '/assets');

define("BASE_URL", "http://localhost/PROJET_FI");