<?php

use App\Core\Database;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Router;

require_once(__DIR__ . '/../bootstrap/app.php');

$router = new Router;

$router->get('/', [PagesController::class, 'index']);
$router->get('/about', [PagesController::class, 'about']);
$router->get('/contact', [PagesController::class, 'contact']);

$router->get('/products', [ProductsController::class, 'index']);
$router->get('/products/create', [ProductsController::class, 'create']);
$router->get('/products/edit', [ProductsController::class, 'edit']);
$router->get('/products/show', [ProductsController::class, 'show']);

$router->post('/products', [ProductsController::class, 'store']);
$router->post('/products/delete', [ProductsController::class, 'delete']);
$router->post('/products/update', [ProductsController::class, 'update']);

$router->post('/cart', [CartController::class, 'show']);
$router->get('/cart', [CartController::class, 'show']);

$router->get('/login', [LoginController::class, 'show']);
$router->post('/login', [LoginController::class, 'store']);
$router->post('/logout', [LoginController::class, 'destroy']);

$router->get('/register', [RegisterController::class, 'show']);
$router->post('/register', [RegisterController::class, 'store']);

$router->resolve();
