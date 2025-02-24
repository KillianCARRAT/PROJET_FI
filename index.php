<?php

require_once __DIR__ . '/src/config/config.php';
require_once __DIR__ . '/src/controllers/Router.php';
require_once __DIR__ . '/autoload.php';

session_start();

use src\controllers\Database;
use Src\Controllers\Router;

$_SESSION["bd"] = Database::getConnection();

$router = new Router();
$router->handleRequest();