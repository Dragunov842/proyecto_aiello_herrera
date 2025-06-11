<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index',['filter'=> 'auth']);
$routes->get('productos', 'Home::menuProductos');
$routes->get('nosotros', 'Home::sobreNosotros');
$routes->get('principio', 'Home::principio');
$routes->get('contactenos', 'Home::contactenos');
$routes->get('condiciones', 'Home::condiciones');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('inicioSesion', 'Home::inicioSesion');

$routes->get('registrar', 'Usuario_controller::create');
$routes->post('enviar-form', 'Usuario_controller::formValidation');
$routes->get('nueva-categoria', 'Categoria_controller::nueva');
$routes->post('guardar-categoria', 'Categoria_controller::guardar');
$routes->get('producto/crear', 'Producto_controller::create');
$routes->post('producto/guardar', 'Producto_controller::formValidation');
$routes->get('login', 'Usuario_controller::login');           
$routes->post('iniciarSesion', 'Usuario_controller::inicioSesion'); 
$routes->get('cerrarSesion', 'Usuario_controller::cerrarSesion'); 

