<?php
require_once __DIR__ . '/../../core/Model.php';

class UserModel extends Model {
    public function getUserById(int $id): ?array {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
