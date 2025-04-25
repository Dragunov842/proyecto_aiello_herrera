<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('productos', 'Home::menuProductos');
$routes->get('nosotros', 'Home::sobreNosotros');
$routes->get('principio', 'Home::principio');