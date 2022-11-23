<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AutenticacionController::index');
$routes->get('login', 'AutenticacionController::index');
$routes->post('checklogin', 'AutenticacionController::login');
$routes->get('about','Home::about');

$routes->post('cambiarpassword', 'AutenticacionController::cambiar');
$routes->get('password','AutenticacionController::password');

//Rutas para gestión de usuarios
$routes->get('usuarios', 'UsuarioController::index');
$routes->get('usuario/crear', 'UsuarioController::crear');
$routes->post('usuario/guardar','UsuarioController::guardar');
$routes->get('usuario/editar/(:num)', 'UsuarioController::editar/$1');
$routes->post('usuario/actualizar','UsuarioController::actualizar');
$routes->get('usuario/borrar/(:num)','UsuarioController::borrar/$1');
$routes->get('getusuarios','UsuarioController::getusuarios');
$routes->get('getusuario/(:num)','UsuarioController::getusuario/$1');

//Rutas para gestión de empleados
$routes->get('empleados', 'EmpleadoController::index');
$routes->get('empleado/crear', 'EmpleadoController::crear');
$routes->post('empleado/guardar','EmpleadoController::guardar');

$routes->get('empleado/(:num)', 'EmpleadoController::ver/$1');

$routes->get('empleado/editar/(:num)', 'EmpleadoController::editar/$1');
$routes->post('empleado/actualizar','EmpleadoController::actualizar');
$routes->get('empleado/borrar/(:num)','EmpleadoController::borrar/$1');
$routes->get('getempleados','EmpleadoController::getempleados');
$routes->get('getempleado/(:num)','EmpleadoController::getempleado/$1');






/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}