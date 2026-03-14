<?php
/** Base model using PDO */
class Model {
    protected $db;

    public function __construct() {
        // Lazy include of DB helper
        require_once __DIR__ . '/../config/database.php';
        $this->db = getPDO();
    }
}
