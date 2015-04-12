<?php
switch ($_SERVER['HTTP_HOST']){
    case 'localhost': {
	define('DEBUGMODE',true);
        $host = "127.0.0.1";
        $user = "root";
        $pass = "";
        $name = "MineSpiration";
        break;
    }
    case 'mine.sygnal.nl': {
	define('DEBUGMODE',true);
        $host = "127.0.0.1";
        $user = "sygnaln_mine";
        $pass = "cbWcJrRK6";
        $name = "sygnaln_mine";
        break;
    }
    default :
        var_dump($_SERVER);
        die();
}
require_once "../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("/model");
$isDevMode = DEBUGMODE;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => $user,
    'password' => $pass,
    'dbname'   => $name,
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$em = EntityManager::create($dbParams, $config);