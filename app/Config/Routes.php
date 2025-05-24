<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::login_action');
$routes->get('logout', 'Login::logout');

// routes Admin
$routes->get('Admin/Home', 'Admin\Home::index', ['filter' => 'AdminFilters']);
$routes->get('Admin/Jabatan', 'Admin\Jabatan::index', ['filter' => 'AdminFilters']);
$routes->get('Admin/Jabatan/Create', 'Admin\Create::index', ['filter' => 'AdminFilters']);
$routes->post('Admin/Jabatan/Store', 'Admin\Store::index', ['filter' => 'AdminFilters']);
$routes->get('Admin/Jabatan/Edit/(:segment)', 'Admin\Jabatan::edit/$1', ['filter' => 'AdminFilters']);
$routes->get('Admin/Jabatan/Update/(:segment)', 'Admin\Jabatan::Update/$1', ['filter' => 'AdminFilters']);
$routes->get('Admin/Jabatan/Delete/(:segment)', 'Admin\Jabatan::Delete/$1', ['filter' => 'AdminFilters']);



// routes mentalSupport
$routes->get('mentalSupport/Home', 'mentalSupport\Home::index', ['filter'=> 'mentalSupportFilters']);
