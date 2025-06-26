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

//usuario
$routes->get('registrar', 'Usuario_controller::create');
$routes->post('enviar-form', 'Usuario_controller::formValidation');
$routes->get('login', 'Usuario_controller::login');   
$routes->get('editarUsuario(:num)', 'Usuario_controller::editar/$1');
$routes->post('actualizarUsuarios(:num)', 'Usuario_controller::actualizar/$1');
$routes->get('eliminarUsuario(:num)', 'Usuario_controller::eliminar/$1');
$routes->get('usuariosEliminados', 'Usuario_controller::eliminados');
$routes->get('activarusuario/(:num)', 'Usuario_controller::activar/$1');
$routes->get('Crud_usuarios','Usuario_controller::index');
$routes->post('iniciarSesion', 'Usuario_controller::inicioSesion'); 
$routes->get('cerrarSesion', 'Usuario_controller::cerrarSesion');


//Productos
$routes->get('crearProducto', 'Producto_controller::crearProducto');
$routes->post('guardarProd', 'Producto_controller::guardarProd');
$routes->get('singleProducto(:num)', 'Producto_controller::singleproducto/$1');
$routes->post('modifica(:num)', 'Producto_controller::modifica/$1');
$routes->get('borrarProducto(:num)', 'Producto_controller::borrarProducto/$1');
$routes->get('eliminados', 'Producto_controller::eliminados');
$routes->get('activarProducto(:num)', 'Producto_controller::activarProducto/$1'); 
$routes->get('Crud_productos','Producto_controller::mostrar'); 

//Categorias
$routes->get('nueva-categoria', 'Categoria_controller::nueva');
$routes->post('guardar-categoria', 'Categoria_controller::guardar');
      
//Listados
$routes->get('listado-productos', 'Listado_Productos::listarProductos');
$routes->post('listado-productosfiltrados', 'Listado_Productos::filtrarProducto');

//Carrito
$routes->post('agregar-al-carrito', 'CarritoController::agregar');
$routes->get('ver-carrito', 'Carrito_controller::index');
$routes->post('carritoActualizarCantidad', 'Carrito_controller::actualizarCantidad');
$routes->get('carritoEliminar(:num)','Carrito_controller::eliminar/$1');
$routes->get('carritoVaciar','Carrito_controller::vaciar');
$routes->get('finalizarCompra', 'Carrito_controller::finalizarCompra');