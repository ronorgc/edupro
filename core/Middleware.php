<?php
class Middleware {
    public static function requireRole(array $roles) {
        if (!isset($_SESSION['user']['role_id'])) {
            header('Location: /login');
            exit;
        }
        $role = (int) ($_SESSION['user']['role_id'] ?? 0);
        if (!in_array($role, $roles)) {
            http_response_code(403);
            echo 'Acceso denegado';
            exit;
        }
    }
}
