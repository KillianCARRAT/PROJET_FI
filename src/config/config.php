<?php

// Définir la constante du chemin de base du projet (la racine de votre projet)
define('BASE_PATH', dirname(__DIR__, 2)); // Déplace BASE_PATH à la racine du projet


// Définir les chemins absolus pour le répertoire public et src
define('PUBLIC_PATH', BASE_PATH . '/public');
define('SRC_PATH', BASE_PATH . '/src');
define('VIEWS_PATH', SRC_PATH . '/Views');
define('CONTROLLERS_PATH', SRC_PATH . '/Controllers');
define('ASSETS_PATH', PUBLIC_PATH . '/assets');

// Si vous utilisez une base de données, vous pouvez y définir les paramètres de connexion
define('DB_HOST', 'localhost');    // Hôte de la base de données
define('DB_USER', 'root');         // Nom d'utilisateur de la base de données
define('DB_PASSWORD', '');         // Mot de passe de la base de données
define('DB_NAME', 'my_database'); // Nom de la base de données

// Mode de développement : définir un mode de débogage ou d'affichage des erreurs
define('DEBUG_MODE', true); // True pour afficher les erreurs, false pour masquer

// Une constante pour la base de l'URL de votre application
define('BASE_URL', 'http://localhost:8000');

// Vous pouvez aussi inclure d'autres configurations spécifiques à votre application ici, comme des clés API ou des paramètres spécifiques.
