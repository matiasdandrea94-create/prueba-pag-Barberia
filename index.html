-- =============================================
--  EL NAVAJERO — Base de datos MySQL
--  Importar este archivo en phpMyAdmin
--  o ejecutar en la consola de MySQL
-- =============================================

CREATE DATABASE IF NOT EXISTS barberia
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_spanish_ci;

USE barberia;

-- TABLA: barberos
CREATE TABLE IF NOT EXISTS barberos (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  nombre   VARCHAR(100) NOT NULL,
  activo   TINYINT(1) DEFAULT 1,
  foto     VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;

INSERT INTO barberos (nombre) VALUES ('Marcos'), ('Nicolás'), ('Rodrigo');

-- TABLA: servicios
CREATE TABLE IF NOT EXISTS servicios (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  nombre      VARCHAR(100) NOT NULL,
  descripcion TEXT,
  precio      DECIMAL(10,2) NOT NULL,
  duracion    INT NOT NULL COMMENT 'Duración en minutos',
  activo      TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO servicios (nombre, descripcion, precio, duracion) VALUES
  ('Corte clásico',    'Tijera y máquina. Prolijo y duradero.',               3500, 30),
  ('Corte + barba',    'Corte completo con arreglo de barba y perfilado.',    5200, 45),
  ('Afeitado navaja',  'Afeitado tradicional con toalla caliente.',           2800, 30),
  ('Barba completa',   'Perfilado, delineado y tratamiento.',                 2500, 30),
  ('Degradé + diseño', 'Degradé skin fade con diseño personalizado.',         4500, 40),
  ('Cejas',            'Depilación y diseño de cejas con cera.',              1500, 20);

-- TABLA: turnos
CREATE TABLE IF NOT EXISTS turnos (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  nombre      VARCHAR(100) NOT NULL,
  telefono    VARCHAR(30),
  barbero_id  INT NOT NULL,
  servicio_id INT NOT NULL,
  fecha       DATE NOT NULL,
  horario     TIME NOT NULL,
  estado      ENUM('Pendiente','Realizado','Cancelado') DEFAULT 'Pendiente',
  notas       TEXT,
  created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (barbero_id)  REFERENCES barberos(id),
  FOREIGN KEY (servicio_id) REFERENCES servicios(id)
) ENGINE=InnoDB;

-- Datos de ejemplo
INSERT INTO turnos (nombre, telefono, barbero_id, servicio_id, fecha, horario, estado) VALUES
  ('Juan Pérez',       '1134567890', 1, 1, CURDATE(), '09:00:00', 'Realizado'),
  ('Carlos Gómez',     '1156781234', 2, 2, CURDATE(), '10:30:00', 'Pendiente'),
  ('Diego Fernández',  '1167890123', 3, 5, CURDATE(), '14:00:00', 'Pendiente'),
  ('Matías López',     '1145678901', 1, 4, CURDATE(), '15:00:00', 'Pendiente'),
  ('Roberto Silva',    '1178901234', 2, 3, DATE_SUB(CURDATE(),INTERVAL 1 DAY), '11:00:00', 'Realizado'),
  ('Pablo Torres',     '1189012345', 3, 1, DATE_SUB(CURDATE(),INTERVAL 1 DAY), '16:30:00', 'Realizado'),
  ('Facundo Martínez', '1190123456', 1, 2, DATE_ADD(CURDATE(),INTERVAL 1 DAY), '09:30:00', 'Pendiente'),
  ('Sebastián Ruiz',   '1101234567', 2, 6, DATE_ADD(CURDATE(),INTERVAL 1 DAY), '11:00:00', 'Pendiente');
