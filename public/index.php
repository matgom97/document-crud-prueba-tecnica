<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Core\Router;
use App\Core\Container;
use App\Contracts\DocumentoRepositoryInterface;
use App\Repositories\DocumentoRepository;
use App\Contracts\DocumentoServiceInterface;
use App\Services\DocumentoService;
use App\Contracts\AuthServiceInterface;
use App\Contracts\TipoRepositoryInterface;
use App\Contracts\ProcesoRepositoryInterface;
use App\Repositories\TipoRepository;
use App\Repositories\ProcesoRepository;
use App\Services\AuthService;
use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;
use App\Core\ExceptionHandler;

/*
|--------------------------------------------------------------------------
| Seguridad de sesión
|--------------------------------------------------------------------------
*/
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

session_start();

/*
|--------------------------------------------------------------------------
| Token CSRF
|--------------------------------------------------------------------------
*/
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/*
|--------------------------------------------------------------------------
| Base de datos
|--------------------------------------------------------------------------
*/
Database::boot();

/*
|--------------------------------------------------------------------------
| Router
|--------------------------------------------------------------------------
*/
$router = new Router();

/*
|--------------------------------------------------------------------------
| Container (IoC)
|--------------------------------------------------------------------------
*/
$container = new Container();

/*
|--------------------------------------------------------------------------
| Bindings (Interfaces → Implementaciones)
|--------------------------------------------------------------------------
*/
$container->bind(DocumentoRepositoryInterface::class, DocumentoRepository::class);
$container->bind(DocumentoServiceInterface::class, DocumentoService::class);
$container->bind(AuthServiceInterface::class, AuthService::class);

$container->bind(TipoRepositoryInterface::class, TipoRepository::class);
$container->bind(ProcesoRepositoryInterface::class, ProcesoRepository::class);

// Middleware binding (opcional pero limpio)
$container->bind(AuthMiddleware::class, AuthMiddleware::class);
$container->bind(CsrfMiddleware::class, CsrfMiddleware::class);

/*
|--------------------------------------------------------------------------
| Cargar rutas
|--------------------------------------------------------------------------
*/
require __DIR__ . '/../routes/web.php';

/*
|--------------------------------------------------------------------------
| Limpiar URI dinámicamente
|--------------------------------------------------------------------------
*/
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = dirname($_SERVER['SCRIPT_NAME']);
$uri = substr($uri, strlen($basePath));

if (!$uri || $uri === '/') {
    $uri = '/login';
}

/*
|--------------------------------------------------------------------------
| Ejecutar router
|--------------------------------------------------------------------------
*/
try {
    $router->dispatch($uri, $_SERVER['REQUEST_METHOD']);
} catch (\Throwable $e) {
    ExceptionHandler::handle($e);
}