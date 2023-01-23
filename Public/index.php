<?php

  /**
  * frontal controller
  *php version 8.0.12 
  * framework -v 0.1.1
  */

require_once('..\Core\Autoloader.php');
Autoloader::register();


use Core\Router\Router;
use Core\Web;

//get a request string
$url = $_SERVER["QUERY_STRING"];

$router = new Router();

// fill routing table 
Web::get($router);

//dispatch request
$router->dispatch($url);