<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::login_action');
$routes->get('logout', 'Login::logout');

$routes->get('Admin/Home', 'Admin\Home::index', ['filter'=> 'AdminFilters']);
$routes->get('mentalSupport/Home', 'mentalSupport\Home::index', ['filter'=> 'mentalSupportFilters']);
