<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'] ?? '')) {
                $_SESSION['user'] = [
                    'id' => (int) $user['id'],
                    'email' => $user['email'] ?? '',
                    'institucion_id' => ($user['institucion_id'] !== null) ? (int) $user['institucion_id'] : null,
                    'role_id' => (int) ($user['role_id'] ?? 0),
                ];
                // Redirigir según rol
                if (isset($user['role_id']) && (int) $user['role_id'] === 1) {
                    header('Location: /superadmin');
                } else {
                    header('Location: /dashboard');
                }
                exit;
            } else {
                $this->render('auth/login', ['error' => 'Credenciales incorrectas']);
                return;
            }
        }
        $this->render('auth/login');
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
