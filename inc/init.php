<?php
session_start();
// ------------------ CONFIGURATION ------------------
define('DIR_ROOT',dirname(dirname(__FILE__)));
define('DB_USERNAME',"root");
define('DB_HOST',"localhost");
define('DB_NAME',"dnkoncina");
define('DB_PASSWORD',"securepass");

ini_set('error_reporting', E_ALL);
// ------------------ CONFIGURATION ------------------
spl_autoload_register(function ($class) { include (DIR_ROOT.'/classes/' . $class . '.class.php'); });
?>
