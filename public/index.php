<?php
require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Database;
use Framework\Router;

$config = require basePath('config/db.php');

$db = new Database($config);

//Instatiate the router
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

//Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//route the request
$router->route($uri);
