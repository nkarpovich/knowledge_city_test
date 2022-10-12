<?php
/*
Register The Auto Loader
*/
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use KnowledgeCity\DataBase;

require __DIR__.'/../vendor/autoload.php';

/*
 * Set the env variables
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'../');
$dotenv->load();
/*
 * Start the application
 */

//$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);
$db = DataBase::instance();
$users = $db->execute('select * from users');
var_dump($users);


/*$host = 'db';
$user = 'MYSQL_USER';
$pass = 'MYSQL_PASSWORD';

// check the MySQL connection status
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL server successfully!";
}*/