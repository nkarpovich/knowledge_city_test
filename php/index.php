<?php
/*
Register The Auto Loader
*/

use KnowledgeCity\DataBase;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__.'/vendor/autoload.php';

/*
 * Set the env variables
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/*
 * Start the application
 */
//$controller->processRequest($_SERVER["REQUEST_METHOD"]);

$db = DataBase::instance();
$users = \KnowledgeCity\Models\User::findAll();
var_dump($users);