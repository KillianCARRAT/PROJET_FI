<?php

require_once __DIR__ . '/src/config/config.php';
require_once __DIR__ . '/src/Controllers/Router.php';


use Src\Controllers\Router;

$router = new Router();
$router->handleRequest();
