<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'TaskController::index');
$routes->get('tasks', 'TaskController::index');
$routes->get('tasks/create', 'TaskController::create');
$routes->get('tasks/create/(:num)', 'TaskController::create/$1');
$routes->post('tasks/store', 'TaskController::store');
$routes->post('tasks/update/(:num)', 'TaskController::update/$1');
$routes->get('tasks/delete/(:num)', 'TaskController::delete/$1');
