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
$routes->get('Admin/Jabatan/Create', 'Admin\Jabatan::Create', ['filter' => 'AdminFilters']);
$routes->post('Admin/Jabatan/Store', 'Admin\Jabatan::store', ['filter' => 'AdminFilters']);
$routes->get('Admin/Jabatan/Edit/(:segment)', 'Admin\Jabatan::edit/$1', ['filter' => 'AdminFilters']);
$routes->post('Admin/Jabatan/Update/(:segment)', 'Admin\Jabatan::update/$1', ['filter' => 'AdminFilters']);
$routes->get('Admin/Jabatan/Delete/(:segment)', 'Admin\Jabatan::Delete/$1', ['filter' => 'AdminFilters']);

$routes->get('Admin/LokasiPresensi', 'Admin\LokasiPresensi::index', ['filter' => 'AdminFilters']);
$routes->get('Admin/LokasiPresensi/Create', 'Admin\LokasiPresensi::create', ['filter' => 'AdminFilters']);
$routes->post('Admin/LokasiPresensi/Store', 'Admin\LokasiPresensi::store', ['filter' => 'AdminFilters']);
$routes->get('Admin/LokasiPresensi/Edit/(:segment)', 'Admin\LokasiPresensi::edit/$1', ['filter' => 'AdminFilters']);
$routes->post('Admin/LokasiPresensi/Update/(:segment)', 'Admin\LokasiPresensi::update/$1', ['filter' => 'AdminFilters']);
$routes->get('Admin/LokasiPresensi/Delete/(:segment)', 'Admin\LokasiPresensi::delete/$1', ['filter' => 'AdminFilters']);


// routes mentalSupport
$routes->get('mentalSupport/Home', 'mentalSupport\Home::index', ['filter'=> 'mentalSupportFilters']);
