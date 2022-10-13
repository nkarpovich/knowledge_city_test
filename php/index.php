<?php
use PHPRouter\RouteCollection;
use PHPRouter\Router;
use PHPRouter\Route;

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ERROR);

/*
 * Register The Auto Loader
 */
require __DIR__ . '/vendor/autoload.php';

/*
 * Set the env variables
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/*
 * Start the session
 */
session_start();

/*
 * Start the application
 */
$collection = new RouteCollection();

$collection->attachRoute(new Route('/users/', array(
    '_controller' => 'KnowledgeCity\Controllers\StudentController::indexAction',
    'methods' => 'GET'
)));
$collection->attachRoute(new Route('/seed/', array(
    '_controller' => 'KnowledgeCity\Controllers\SeedController::indexAction',
    'methods' => 'GET'
)));
$collection->attachRoute(new Route('/auth/', array(
    '_controller' => 'KnowledgeCity\Controllers\AuthController::loginAction',
    'methods' => 'POST'
)));
$collection->attachRoute(new Route('/auth/', array(
    '_controller' => 'KnowledgeCity\Controllers\AuthController::logoutAction',
    'methods' => 'DELETE'
)));

$router = new Router($collection);
$router->setBasePath('/api');
$route = $router->matchCurrentRequest();