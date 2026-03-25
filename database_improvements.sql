-- ============================================
-- database_improvements.sql
-- ============================================
-- Mejoras de estructura, índices y constraints
-- Ejecutar DESPUÉS de crear las tablas originales
-- ============================================

-- ============================================
-- 1. AGREGAR ÍNDICES PARA PERFORMANCE
-- ============================================

-- Índice en turnos por barbero + fecha (búsquedas frecuentes)
ALTER TABLE turnos ADD INDEX idx_barbero_fecha (barbero_id, fecha);

-- Índice en turnos por estado (filtros de admin)
ALTER TABLE turnos ADD INDEX idx_estado (estado);

-- Índice en turnos por fecha (reportes)
ALTER TABLE turnos ADD INDEX idx_fecha (fecha);

-- Índice compuesto para consultas de horarios disponibles
ALTER TABLE turnos ADD INDEX idx_barbero_fecha_estado (barbero_id, fecha, estado);

-- Índice en barberos activos
ALTER TABLE barberos ADD INDEX idx_activo (activo);

-- Índice en servicios activos
ALTER TABLE servicios ADD INDEX idx_activo (activo);

-- ============================================
-- 2. MEJORAR CONSTRAINTS Y VALIDACIONES EN BD
-- ============================================

-- Convertir campo estado a ENUM si usas MySQL 8+
-- (Primero hacer copia de seguridad de datos)
-- ALTER TABLE turnos MODIFY estado ENUM('Pendiente', 'Realizado', 'Cancelado') DEFAULT 'Pendiente';

-- Agregar NOT NULL y defaults donde hace falta
ALTER TABLE turnos MODIFY nombre VARCHAR(100) NOT NULL;
ALTER TABLE turnos MODIFY telefono VARCHAR(20) NOT NULL;
ALTER TABLE turnos MODIFY fecha DATE NOT NULL;
ALTER TABLE turnos MODIFY horario TIME NOT NULL;
ALTER TABLE turnos MODIFY estado ENUM('Pendiente', 'Realizado', 'Cancelado') NOT NULL DEFAULT 'Pendiente';
ALTER TABLE turnos MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP;

-- Agregar validación de precios positivos
ALTER TABLE servicios ADD CONSTRAINT chk_precio_positivo CHECK (precio > 0);

-- Agregar validación de duración válida
ALTER TABLE servicios ADD CONSTRAINT chk_duracion_valida CHECK (duracion > 0 AND duracion <= 120);

-- ============================================
-- 3. AGREGAR CAMPOS PARA AUDITORÍA
-- ============================================

-- Agregar campos de auditoría a turnos
ALTER TABLE turnos ADD COLUMN updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE turnos ADD COLUMN updated_by INT;

-- Tabla de logs de auditoría (opcional, pero recomendado)
CREATE TABLE IF NOT EXISTS turnos_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    turno_id INT NOT NULL,
    accion ENUM('Creado', 'Actualizado', 'Eliminado') NOT NULL,
    estado_anterior VARCHAR(50),
    estado_nuevo VARCHAR(50),
    usuario_id INT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    detalles TEXT,
    FOREIGN KEY (turno_id) REFERENCES turnos(id) ON DELETE CASCADE,
    INDEX idx_turno_fecha (turno_id, timestamp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. TABLA PARA TOKENS DE AUTENTICACIÓN (opcional)
-- ============================================

CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,  -- Usar password_hash() de PHP
    activo TINYINT DEFAULT 1,
    ultimo_login DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_activo (activo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar usuario admin de prueba (cambiar contraseña!)
-- Password: admin123 (hashed con password_hash)
INSERT INTO admin_users (username, email, password_hash) VALUES (
    'admin',
    'admin@barberia.com',
    '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36gZvWQm'
);

-- ============================================
-- 5. TABLA PARA CONFIGURACIÓN DEL SISTEMA
-- ============================================

CREATE TABLE IF NOT EXISTS config (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) UNIQUE NOT NULL,
    `value` LONGTEXT,
    tipo ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
    descripcion TEXT,
    INDEX idx_key (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Configuraciones iniciales
INSERT INTO config (`key`, value, tipo, descripcion) VALUES
('hora_inicio', '09:00', 'string', 'Hora de apertura (formato HH:MM)'),
('hora_cierre', '19:30', 'string', 'Hora de cierre (formato HH:MM)'),
('intervalo_turnos', '30', 'number', 'Intervalo entre turnos en minutos'),
('dias_anticipados_max', '90', 'number', 'Máximo de días para reservar adelantado'),
('duracion_default', '30', 'number', 'Duración por defecto en minutos');

-- ============================================
-- 6. TABLA PARA HORARIOS PERSONALIZADOS
-- ============================================

CREATE TABLE IF NOT EXISTS horarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barbero_id INT NOT NULL,
    fecha DATE,
    dia_semana INT,  -- 0=lunes, 6=domingo
    hora_inicio TIME,
    hora_cierre TIME,
    activo TINYINT DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (barbero_id) REFERENCES barberos(id) ON DELETE CASCADE,
    INDEX idx_barbero_fecha (barbero_id, fecha),
    INDEX idx_barbero_dia (barbero_id, dia_semana)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 7. OPTIMIZACIONES FINALES
-- ============================================

-- Analizar tablas para que MySQL tenga estadísticas actualizadas
ANALYZE TABLE barberos;
ANALYZE TABLE servicios;
ANALYZE TABLE turnos;

-- Mostrar índices creados
SHOW INDEX FROM turnos;
SHOW INDEX FROM barberos;
SHOW INDEX FROM servicios;

-- Ver tamaño de tablas
SELECT 
    table_name,
    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb
FROM information_schema.TABLES
WHERE table_schema = 'barberia'
ORDER BY (data_length + index_length) DESC;
