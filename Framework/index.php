<?php

namespace Frame;

ini_set('display_errors', '1');

define('CONFIG', include 'App/config.php');
define('ROUTE', $_SERVER['PATH_INFO'] ?? '/');

include "AutoloaderPSR4.php";
AutoloaderPSR4::$config = CONFIG['Autoloader'];
new AutoloaderPSR4;

Router::$config = CONFIG['Router'];
new Router();

// PDOHandler::getInstance('MYAPP', config['DB']);
// header('Cache-Control: no-cache', true);;
