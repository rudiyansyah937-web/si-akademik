<?php
session_start();

const APP_DEBUG = false;

$logDir = __DIR__ . '/../storage/logs';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0777, true);
}
ini_set('display_errors', APP_DEBUG ? '1' : '0');
ini_set('log_errors', '1');
ini_set('error_log', $logDir . '/app.log');
error_reporting(E_ALL);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/core/AppException.php';
require_once __DIR__ . '/../app/core/Logger.php';
require_once __DIR__ . '/../app/core/BaseController.php';
require_once __DIR__ . '/../app/Repositories/MahasiswaRepository.php';
require_once __DIR__ . '/../app/Services/MahasiswaService.php';
require_once __DIR__ . '/../app/controllers/MahasiswaController.php';

$routes = require __DIR__ . '/../routes/web.php';

define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (BASE_URL !== '' && str_starts_with($uri, BASE_URL)) {
    $uri = substr($uri, strlen(BASE_URL));
}
$uri    = '/' . trim($uri, '/');
$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($uri === '/') {
        header('Location: ' . BASE_URL . '/mahasiswa');
        exit;
    }

    if (!isset($routes[$method][$uri])) {
        http_response_code(404);
        echo '<h1>404 - Halaman tidak ditemukan</h1>';
        exit;
    }

    [$controllerName, $action] = $routes[$method][$uri];

    $database   = new Database();
    $repository = new MahasiswaRepository($database);
    $service    = new MahasiswaService($repository);
    $controller = new $controllerName($service);

    $controller->$action();
} catch (Throwable $e) {
    Logger::error('Kesalahan tidak terduga', $e);
    http_response_code(500);
    echo '<h1>Terjadi kesalahan pada sistem.</h1><p>Silakan coba lagi nanti.</p>';
}