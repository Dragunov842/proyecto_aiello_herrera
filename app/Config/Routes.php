<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index',['filter'=> 'auth']);
$routes->get('Catalogo', 'Home::menuProductos');
$routes->get('nosotros', 'Home::sobreNosotros');
$routes->get('principio', 'Home::principio');
$routes->get('contactenos', 'Home::contactenos');
$routes->get('condiciones', 'Home::condiciones');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('inicioSesion', 'Home::inicioSesion');

$routes->get('registrar', 'Usuario_controller::create');
$routes->post('enviar-form', 'Usuario_controller::formValidation');
$routes->get('login', 'Usuario_controller::login');           
$routes->post('iniciarSesion', 'Usuario_controller::inicioSesion');
$routes->get('cerrarSesion', 'Usuario_controller::cerrarSesion'); 
$routes->get('Crud_usuarios', 'Usuario_controller::index');
$routes->get('eliminarUsuario/(:num)', 'Usuario_controller::eliminar/$1');
$routes->get('usuariosEliminados', 'Usuario_controller::eliminados');
$routes->get('activarusuario/(:num)', 'Usuario_controller::activar/$1');
$routes->get('editarUsuario', 'Usuario_controller::editar'); 
$routes->post('actualizarUsuario', 'Usuario_controller::actualizar'); 

$routes->get('nueva-categoria', 'Categoria_controller::nueva');
$routes->post('guardar-categoria', 'Categoria_controller::guardar');
 

$routes->get('producto', 'Producto_controller::index');
$routes->get('producto/crear', 'Producto_controller::create');
$routes->post('producto/guardar', 'Producto_controller::guardar');
$routes->get('listado-productos', 'Listado_Productos::listarProductos');
$routes->post('listado-productos/filtrar', 'Listado_Productos::filtrarProducto');
$routes->get('editarProducto', 'Producto_controller::editar');
$routes->post('actualizarProducto', 'Producto_controller::actualizar');
$routes->get('eliminar', 'Producto_controller::eliminar');
$routes->get('eliminados', 'Producto_controller::eliminados');
$routes->get('activar_pro', 'Producto_controller::restaurar');


$routes->get('carrito', 'CarritoController::index');              
$routes->get('carrito/agregar/(:num)', 'CarritoController::agregar/$1'); 
$routes->post('carrito/eliminar', 'CarritoController::eliminarProducto');
$routes->get('carrito/vaciar', 'CarritoController::vaciar');      
$routes->post('carrito/finalizar', 'CarritoController::finalizarCompra'); 

$routes->get('ventas', 'VentasCabeceraController::listarVentas');   
$routes->get('ventas/detalle/(:num)', 'VentasDetalleController::verDetalle/$1'); 
$routes->post('ventas/crear', 'VentasCabeceraController::crear');

