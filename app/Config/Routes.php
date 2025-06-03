<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('productos', 'Home::menuProductos');
$routes->get('nosotros', 'Home::sobreNosotros');
$routes->get('principio', 'Home::principio');
$routes->get('contactenos', 'Home::contactenos');
$routes->get('condiciones', 'Home::condiciones');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('registro', 'Home::formularios');
$routes->post('enviar-form', 'Usuario_controller::formValidation');
