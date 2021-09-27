<?php

namespace Frame;

ini_set('display_errors', '1');
define('config', include 'App/config.php');

include "AutoloaderPSR4.php";
AutoloaderPSR4::$config = config['Autoloader'];
AutoloaderPSR4::auto();

PDOHandler::getInstance('MYAPP', config['DB']);

header('Cache-Control: no-cache', true);


// unset($conf);
// var_dump(new Config('Framework/cache/test_Config.php'));

Router::$config = config['Router'];
Router::route();
