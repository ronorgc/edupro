<?php
// Cargando variables desde .env si existe (muy básico)
if (function_exists('getenv') && getenv('DB_HOST')) {
    $DB_HOST = getenv('DB_HOST');
    $DB_NAME = getenv('DB_NAME');
    $DB_USER = getenv('DB_USER');
    $DB_PASS = getenv('DB_PASS');
    $DB_CHARSET = getenv('DB_CHARSET') ?: 'utf8mb4';
} else {
    // Valores por defecto de desarrollo
    $DB_HOST = 'localhost';
    $DB_NAME = 'edupro_db';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_CHARSET = 'utf8mb4';
}

function getPDO() {
    global $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_CHARSET;
    $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";
    try {
        $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (Exception $e) {
        if (defined('APP_DEBUG') && APP_DEBUG) {
            throw $e;
        }
        return null;
    }
}

?>
