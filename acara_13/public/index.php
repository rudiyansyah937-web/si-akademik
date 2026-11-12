<?php
session_start();

require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Repositories/MahasiswaRepository.php';
require_once __DIR__ . '/../app/Repositories/ProdiRepository.php';
require_once __DIR__ . '/../app/Repositories/MatkulRepository.php';
require_once __DIR__ . '/../app/Services/MahasiswaService.php';

use App\Config\Database;
use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use App\Repositories\MatkulRepository;
use App\Services\MahasiswaService;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
if ($base !== '' && str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base));
}
$uri = '/' . trim($uri, '/');

$method = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$method][$uri])) {
    $route = $routes[$method][$uri];

    if (isset($route['middleware'])) {
        foreach ($route['middleware'] as $mw) {
            require_once __DIR__ . '/../app/core/Middleware/AuthMiddleware.php';
            $mwInstance = new $mw();
            $mwInstance->handle();
        }
    }

    $controllerName  = $route['controller'];
    $action          = $route['action'];
    $controllerClass = "App\\Controllers\\{$controllerName}";

    require_once __DIR__ . "/../app/controllers/{$controllerName}.php";

    $database = new Database();

    if ($controllerName === 'MahasiswaController') {
        $repository = new MahasiswaRepository($database);
        $service    = new MahasiswaService($repository);
        $controller = new $controllerClass($service);
    } elseif ($controllerName === 'ProdiController') {
        $repository = new ProdiRepository($database);
        $controller = new $controllerClass($repository);
    } elseif ($controllerName === 'MatkulController') {
        $repository = new MatkulRepository($database);
        $controller = new $controllerClass($repository);
    } else {
        $controller = new $controllerClass();
    }

    $controller->$action();
} else {
    http_response_code(404);
    echo "<h1>404 - Halaman tidak ditemukan</h1>";
}