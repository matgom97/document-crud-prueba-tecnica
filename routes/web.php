<?php

use App\Controllers\AuthController;
use App\Controllers\DocumentoController;
use App\Middleware\AuthMiddleware;

/** @var \App\Core\Container $container */
/** @var \App\Core\Router $router */

// Resolver controladores usando el Container
$authController = $container->make(AuthController::class);
$documentoController = $container->make(DocumentoController::class);

/*
|--------------------------------------------------------------------------
| Rutas públicas (NO protegidas)
|--------------------------------------------------------------------------
*/
$router->get('/login', [$authController, 'showLogin']);
$router->post('/login', [$authController, 'login']);

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren autenticación)
|--------------------------------------------------------------------------
*/
$router->get('/logout', [$authController, 'logout'])
       ->middleware(AuthMiddleware::class);

$router->get('/documentos', [$documentoController, 'index'])
       ->middleware(AuthMiddleware::class);

$router->get('/documentos/create', [$documentoController, 'createForm'])
       ->middleware(AuthMiddleware::class);

$router->post('/documentos', [$documentoController, 'store'])
       ->middleware(AuthMiddleware::class);

$router->get('/documentos/edit', [$documentoController, 'editForm'])
       ->middleware(AuthMiddleware::class);

$router->post('/documentos/update', [$documentoController, 'update'])
       ->middleware(AuthMiddleware::class);

$router->post('/documentos/delete', [$documentoController, 'delete'])
       ->middleware(AuthMiddleware::class);