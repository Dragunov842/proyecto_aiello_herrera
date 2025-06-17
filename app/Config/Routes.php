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
$routes->get('listado-productos', 'Listado_Productos::listarProductos');
$routes->post('listado-productos/filtrar', 'Listado_Productos::filtrarProducto');
$routes->get('editar', 'Productocontroller::singleproducto');
$routes->post('modifica', 'Productocontroller::modifica');
$routes->get('borrar', 'Productocontroller::deleteproducto');
$routes->get('eliminados', 'Productocontroller::eliminados');
$routes->get('activar_pro', 'Productocontroller::activarproducto');
$routes->get('Crud_usuarios', 'Usuario_controller::index');
$routes->get('editarUsuario/(:num)', 'Usuario_controller::editar/$1');
$routes->post('actualizarUsuario/(:num)', 'Usuario_controller::actualizar/$1');
$routes->get('eliminarUsuario/(:num)', 'Usuario_controller::eliminar/$1');
$routes->get('usuariosEliminados', 'Usuario_controller::eliminados');
$routes->get('activarusuario/(:num)', 'Usuario_controller::activar/$1');

