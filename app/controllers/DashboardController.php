<?php
require_once __DIR__ . '/../../core/Controller.php';

class DashboardController extends Controller {
    public function index() {
        $user = $_SESSION['user'] ?? null;
        $this->render('dashboard/index', ['title' => 'Dashboard', 'user' => $user]);
    }
}
