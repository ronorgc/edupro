<?php
require_once __DIR__ . '/../config/database.php';

$pdo = getPDO();
if (!$pdo) {
    fwrite(STDERR, "DB connection failed.\n");
    exit(1);
}

function getInstitucionId(PDO $pdo, string $name): int {
    $s = $pdo->prepare('SELECT id FROM instituciones WHERE nombre = :name LIMIT 1');
    $s->execute([':name' => $name]);
    $row = $s->fetch();
    if ($row && isset($row['id'])) {
        return (int)$row['id'];
    }
    $ins = $pdo->prepare('INSERT INTO instituciones (nombre) VALUES (:name)');
    $ins->execute([':name' => $name]);
    return (int)$pdo->lastInsertId();
}

// Seed passwords (hashes) using PHP
$passSuper = password_hash('SuperAdmin123!', PASSWORD_BCRYPT);
$passAdmin = password_hash('Admin123!', PASSWORD_BCRYPT);
$passProf  = password_hash('Prof123!', PASSWORD_BCRYPT);
$passEst   = password_hash('Estudiante123!', PASSWORD_BCRYPT);
$passPadre  = password_hash('Padre123!', PASSWORD_BCRYPT);

try {
    // 1) Super Admin (global, institucion_id NULL)
    $stmt = $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (NULL, :email, :pwd, 1)');
    $stmt->execute([':email' => 'superadmin@edupro', ':pwd' => $passSuper]);
    // 2) Admin de Colegio (asociado a una InstitucionDemo)
    $instId = getInstitucionId($pdo, 'Institucion Demo');
    $stmt = $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (:inst, :email, :pwd, 2)');
    $stmt->execute([':inst' => $instId, ':email' => 'admin@institucion', ':pwd' => $passAdmin]);
    // 3) Profesor
    $stmt = $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (:inst, :email, :pwd, 3)');
    $stmt->execute([':inst' => $instId, ':email' => 'profesor@institucion', ':pwd' => $passProf]);
    // 4) Estudiante
    $stmt = $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (:inst, :email, :pwd, 4)');
    $stmt->execute([':inst' => $instId, ':email' => 'estudiante@institucion', ':pwd' => $passEst]);
    // 5) Padre
    $stmt = $pdo->prepare('INSERT INTO users (institucion_id, email, password, role_id) VALUES (:inst, :email, :pwd, 5)');
    $stmt->execute([':inst' => $instId, ':email' => 'padre@institucion', ':pwd' => $passPadre]);
    echo "Seed completed.\n";
} catch (Exception $e) {
    // Evitar detener por duplicados; solo reportar
    fwrite(STDERR, "Seed error: " . $e->getMessage() . "\n");
}
