<?php

require_once __DIR__ . '/src/config/config.php';
require_once __DIR__ . '/src/controllers/Router.php';
require_once __DIR__ . '/autoload.php';


session_set_cookie_params([
    'lifetime' => 0, // Session expire à la fermeture du navigateur
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'], // Assure que le domaine est bien défini
    'secure' => isset($_SERVER['HTTPS']), // Active uniquement en HTTPS
    'httponly' => true, // Empêche l'accès au cookie via JavaScript
    'samesite' => 'Lax' // Empêche certains problèmes de redirection
]);
session_start();

use Src\Controllers\Router;

$router = new Router();
$router->handleRequest();