<?php
require_once('libs/Router.php');
require_once('Controllers/Tours.Controller.php');
require_once('Controllers/Cruceros.Controller.php');
require_once('Controllers/Usuarios.Controller.php');


/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 | CONSTANTES PARA RUTEO. |
 *------------------------*/
define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]) . '/');

/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 | Recurso solicitado. |
 *---------------------*/
$resource = $_GET["resource"];

/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 | Método utilizado. |
 *-------------------*/
$method = $_SERVER["REQUEST_METHOD"];

/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 | Crea el router. |
 *-----------------*/
$router = new Router();

/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 | Define la tabla de ruteo. |
 *---------------------------*/

//TOURS
$router->addRoute('/tours', 'GET', 'ToursController', 'getTours');
$router->addRoute('/tours', 'POST', 'ToursController', 'addTour');
$router->addRoute('/tours/:ID', 'GET', 'ToursController', 'getTour');
$router->addRoute('/tours/:ID', 'DELETE', 'ToursController', 'deleteTour');
$router->addRoute("/tours/:ID", "PUT", "ToursController", 'updateTour');
//CRUCEROS
$router->addRoute('/cruceros', 'GET', 'CrucerosController', 'getCruceros');
$router->addRoute('/cruceros', 'POST', 'CrucerosController', 'addCrucero');
$router->addRoute('/cruceros/:ID', 'GET', 'CrucerosController', 'getCrucero');
$router->addRoute('/cruceros/:ID', 'DELETE', 'CrucerosController', 'deleteCrucero');
$router->addRoute("/cruceros/:ID", "PUT", "CrucerosController", 'updateCrucero');
//USUARIOS
$router->addRoute('usuarios','POST','UsuariosController','login');
/*¯¯¯¯¯¯¯¯¯*
 |  RUTEA. |
 *---------*/
$router->route($resource, $method);