<?php

namespace Config;

use App\Controllers\HomeController;
use App\Controllers\ServerController;
use App\Controllers\StaticPageController;
use App\Controllers\AddServerController;
use App\Controllers\AdminController;
use Config\Services;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', [HomeController::class, 'index']);
$routes->get('/servers', [ServerController::class, 'index']);
$routes->get('/server/(:segment)', [ServerController::class, 'show']);
$routes->post('/server/(:segment)/vote', [ServerController::class, 'vote']);
$routes->get('/rules', [StaticPageController::class, 'rules']);
$routes->get('/promo', [StaticPageController::class, 'promo']);
$routes->get('/about', [StaticPageController::class, 'about']);
$routes->get('/add', [AddServerController::class, 'index']);
$routes->post('/add', [AddServerController::class, 'store']);
$routes->get('/admin', [AdminController::class, 'index']);
$routes->post('/admin/login', [AdminController::class, 'login']);
$routes->post('/admin/logout', [AdminController::class, 'logout']);
$routes->post('/admin/moderate/(:num)', [AdminController::class, 'moderate']);
