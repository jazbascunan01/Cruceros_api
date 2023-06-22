<?php
require_once ('libs/Router.php');
require_once('Controllers/Tours.Controller.php');



// CONSTANTES PARA RUTEO
define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

// recurso solicitado
$resource = $_GET["resource"];

// método utilizado
$method = $_SERVER["REQUEST_METHOD"];

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('/tours', 'GET', 'ToursController', 'getTours');
$router->addRoute('/tours', 'POST', 'ToursController', 'addTour');
$router->addRoute('/tours/:ID', 'GET', 'ToursController', 'getTour');
$router->addRoute('/tours/:ID', 'DELETE', 'ToursController', 'deleteTour');
$router->addRoute("/tours/:ID", "PUT", "ToursController", 'updateTour');
// rutea
$router->route($resource, $method);