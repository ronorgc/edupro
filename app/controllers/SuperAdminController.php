<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/Middleware.php';

class SuperAdminController extends Controller {
    public function __construct() {
        Middleware::requireRole([1]);
    }

    public function index() {
        $this->render('superadmin/index', ['title' => 'Super Admin']);
    }
}
