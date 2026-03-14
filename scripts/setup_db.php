<?php
require_once __DIR__ . '/../config/database.php';

$pdo = getPDO();
if (!$pdo) {
    fwrite(STDERR, "DB connection failed.\n");
    exit(1);
}

// Ensure migrations_applied tracking table exists
$pdo->exec("CREATE TABLE IF NOT EXISTS migrations_applied (
  name VARCHAR(255) PRIMARY KEY,
  applied_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
)" );

// Apply migrations in order if not yet applied
$migrationDir = __DIR__ . '/../database/migrations';
$files = array_filter(scandir($migrationDir), function($f) {
    return preg_match('/^\d{3}_.+\.sql$/', $f);
});
sort($files);

foreach ($files as $file) {
    $stmt = $pdo->prepare('SELECT 1 FROM migrations_applied WHERE name = :name');
    $stmt->execute([':name' => $file]);
    if ($stmt->fetch()) {
        continue; // already applied
    }
    $sql = file_get_contents($migrationDir . '/' . $file);
    if ($sql) {
        $pdo->exec($sql);
        $pdo->prepare('INSERT INTO migrations_applied (name) VALUES (:name)')->execute([':name' => $file]);
        echo "Applied migration: $file\n";
    }
}

// Seed roles to ensure idempotent insertion
$roles = [
  [1, 'SUPER_ADMIN'],
  [2, 'ADMIN_COLEGIO'],
  [3, 'PROFESOR'],
  [4, 'ESTUDIANTE'],
  [5, 'PADRE']
];
foreach ($roles as $r) {
    $stmt = $pdo->prepare('INSERT INTO roles (id, nombre) VALUES (:id, :name) ON DUPLICATE KEY UPDATE nombre = :name');
    $stmt->execute([':id' => $r[0], ':name' => $r[1]]);
}

// Seed a basic institution and users if not present
// Helper to get or create institution id
function getInstitucionId(PDO $pdo, string $name): int {
    $stmt = $pdo->prepare('SELECT id FROM instituciones WHERE nombre = :name LIMIT 1');
    $stmt->execute([':name' => $name]);
    $row = $stmt->fetch();
    if ($row && isset($row['id'])) {
        return (int)$row['id'];
    }
    $ins = $pdo->prepare('INSERT INTO instituciones (nombre) VALUES (:name)');
    $ins->execute([':name' => $name]);
    return (int)$pdo->lastInsertId();
}

$instId = getInstitucionId($pdo, 'Institucion Demo');

// Passwords (bcrypt)
$hashSuper = password_hash('SuperAdmin123!', PASSWORD_BCRYPT);
$hashAdmin = password_hash('Admin123!', PASSWORD_BCRYPT);
$hashProf  = password_hash('Prof123!', PASSWORD_BCRYPT);
$hashEst   = password_hash('Estudiante123!', PASSWORD_BCRYPT);
$hashPadre  = password_hash('Padre123!', PASSWORD_BCRYPT);

// Check if super admin exists
$check = $pdo->prepare('SELECT id FROM users WHERE email = :email');
$check->execute([':email' => 'superadmin@edupro']);
if (!$check->fetch()) {
    // Super Admin (global)
    $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (NULL, :email, :pwd, 1)')->execute([':email' => 'superadmin@edupro', ':pwd' => $hashSuper]);
    // Admins/Profs/Stu/Padre for Institucion Demo
    $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (:inst, :email, :pwd, 2)')->execute([':inst' => $instId, ':email' => 'admin@institucion', ':pwd' => $hashAdmin]);
    $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (:inst, :email, :pwd, 3)')->execute([':inst' => $instId, ':email' => 'profesor@institucion', ':pwd' => $hashProf]);
    $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (:inst, :email, :pwd, 4)')->execute([':inst' => $instId, ':email' => 'estudiante@institucion', ':pwd' => $hashEst]);
    $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (:inst, :email, :pwd, 5)')->execute([':inst' => $instId, ':email' => 'padre@institucion', ':pwd' => $hashPadre]);
    echo "Seed completed.\n";
} else {
    echo "Seed already exists.\n";
}
