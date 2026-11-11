<?php
session_start();

require_once __DIR__ . '/../app/core/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/MahasiswaController.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/Model.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/Model.php';
require_once __DIR__ . '/../app/models/MahasiswaModel.php';

$routes = require __DIR__ . '/../routes/web.php';

$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
define('BASE_URL', $basePath);

function redirect(string $path): void
{
    header('Location: ' . BASE_URL . $path);
    exit;
}

function flash(string $key): ?string
{
    $value = $_SESSION[$key] ?? null;
    unset($_SESSION[$key]);
    return $value;
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($basePath !== '' && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
$uri    = '/' . trim($uri, '/');
$method = $_SERVER['REQUEST_METHOD'];

$found = false;

foreach ($routes[$method] ?? [] as $pattern => $route) {
    [$controllerName, $action] = $route;
    $middlewares = $route[2] ?? [];

    $regex = '#^' . preg_replace('#\{[a-z_]+\}#', '(\d+)', $pattern) . '$#';

    if (preg_match($regex, $uri, $matches)) {
        array_shift($matches);

        foreach ($middlewares as $middlewareName) {
            (new $middlewareName())->handle();
        }

        $controller = new $controllerName();
        $controller->$action(...array_map('intval', $matches));
        $found = true;
        break;
    }
}

if (!$found) {
    http_response_code(404);
    echo '404 - Halaman tidak ditemukan';
}