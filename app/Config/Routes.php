<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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

// Controller post
// $routes->get('/', 'Home::index');

$routes->get('/post', 'PostController::index');
$routes->get('/post/(:num)', 'PostController::show/$1');
$routes->post('/post/create', 'PostController::create');
$routes->put('/post/(:num)', 'PostController::update/$1');
$routes->delete('/post/(:num)', 'PostController::delete/$1');


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
