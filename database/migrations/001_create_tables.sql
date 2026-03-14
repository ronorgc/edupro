-- Migration 001: Crear tablas básicas para usuarios, roles e instituciones
CREATE TABLE IF NOT EXISTS instituciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  direccion VARCHAR(512) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  institucion_id INT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role_id INT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (institucion_id) REFERENCES instituciones(id) ON DELETE CASCADE,
  FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL
);

-- Seed de roles (1: Super Admin, 2: Admin Colegio, 3: Profesor, 4: Estudiante, 5: Padre)
INSERT INTO roles (id, nombre) VALUES
  (1, 'SUPER_ADMIN'),
  (2, 'ADMIN_COLEGIO'),
  (3, 'PROFESOR'),
  (4, 'ESTUDIANTE'),
  (5, 'PADRE');
