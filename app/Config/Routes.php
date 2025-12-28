<?php

namespace Config;

use App\Controllers\HomeController;
use App\Controllers\ServerController;
use App\Controllers\StaticPageController;
use App\Controllers\PlaceholderController;
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
$routes->get('/rules', [StaticPageController::class, 'rules']);
$routes->get('/promo', [StaticPageController::class, 'promo']);
$routes->get('/about', [StaticPageController::class, 'about']);
$routes->get('/add', [PlaceholderController::class, 'add']);
$routes->get('/admin', [PlaceholderController::class, 'admin']);
