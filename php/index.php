<?php
/*
Register The Auto Loader
*/
require __DIR__.'/vendor/autoload.php';

use PHPRouter\RouteCollection;
use PHPRouter\Router;
use PHPRouter\Route;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);

/*
 * Set the env variables
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/*
 * Start the application
 */
$collection = new RouteCollection();

$collection->attachRoute(new Route('/users/', array(
    '_controller' => 'KnowledgeCity\Controllers\UserController::indexAction',
    'methods' => 'GET'
)));

/*$collection->attachRoute(new Route('/', array(
    '_controller' => '\KnowledgeCity\Controllers\UserController::indexAction',
    'methods' => 'GET'
)));*/

$router = new Router($collection);
$router->setBasePath('/api');
$route = $router->matchCurrentRequest();