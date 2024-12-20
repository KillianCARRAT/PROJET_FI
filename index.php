<?php

require_once __DIR__ . '/src/config/config.php';
require_once __DIR__ . '/src/controllers/Router.php';
require_once __DIR__ . '/autoload.php';

session_start();

use Src\Controllers\Router;

$router = new Router();
$router->handleRequest();