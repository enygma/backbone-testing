<?php
include_once 'fw/loader.php';
//include_once 'app/vendor/autoload.php';

$load  = new Fw\Autoload();
$route = new Fw\Router();

// define an APP_ROOT
define('APP_ROOT',__DIR__);

$route->handle();
?>
