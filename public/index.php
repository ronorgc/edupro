<?php
// Fallback if config isn't loaded yet
if (!defined('APP_ENV')) {
  define('APP_ENV', 'development');
}
// Inicialización básica del sistema MVC propio
require_once __DIR__ . '/../config/config.php';

// Simple error reporting based on environment
if (APP_ENV === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

require_once __DIR__ . '/../core/Router.php';

$router = new Router();
// Rutas básicas
$router->addRoute('/', 'HomeController', 'index');

// Resolve path (ignoring /edupro/public prefix when running under subfolder)
$uri = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$base = rtrim(str_replace('\\','/', dirname($scriptName)), '/');
$path = '/' . ltrim(substr($uri, strlen($base)), '/');
$path = strtok($path, '?');
if ($path === '') $path = '/';

$router->dispatch($path);
