<?php
/**
 * =====================================================
 * config.php — Configuración Central de la API
 * =====================================================
 * Este archivo contiene:
 *  • Credenciales de acceso a la base de datos MySQL
 *  • Función de conexión a la BD
 *  • Headers CORS para permitir llamadas desde el frontend
 *  • Validación de solicitudes OPTIONS (preflight de CORS)
 * 
 * IMPORTANTE: En producción, usar variables de entorno para
 * credenciales sensibles, no hardcoded en el código.
 * =====================================================
 */

// ──────────────────────────────────────────────────
// Credenciales de Base de Datos
// ──────────────────────────────────────────────────
// Modificá estos valores según tu configuración de XAMPP/MySQL
define('DB_HOST', 'localhost');  // Servidor MySQL (localhost para desarrollo local)
define('DB_USER', 'root');        // Usuario MySQL (por defecto 'root' en XAMPP)
define('DB_PASS', '');             // Contraseña MySQL (vacía por defecto en XAMPP)
define('DB_NAME', 'barberia');    // Nombre de la base de datos

/**
 * Función para obtener conexión a la base de datos
 * 
 * @return mysqli Objeto de conexión MySQLi a la BD
 * @throws Error Si fallan las credenciales o la conexión
 */
function getDB() {
    // Crear nueva conexión con MySQLi (procedural style)
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Validar que la conexión se haya establecido correctamente
    if ($conn->connect_error) {
        http_response_code(500);
        die(json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]));
    }
    
    // Configurar charset UTF-8 para soportar caracteres especiales
    $conn->set_charset('utf8mb4');
    return $conn;
}

// ──────────────────────────────────────────────────
// Headers CORS y Configuración de Respuesta
// ──────────────────────────────────────────────────
// Headers para desarrollo local - permitir solicitudes desde cualquier origen
header('Content-Type: application/json; charset=utf-8');  // Las respuestas serán JSON con UTF-8
header('Access-Control-Allow-Origin: *');                 // Permitir acceso desde cualquier dominio (cambiar en producción)
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');  // Métodos HTTP permitidos
header('Access-Control-Allow-Headers: Content-Type');     // Headers permitidos en solicitudes

/**
 * Validación de solicitudes preflight de CORS
 * El navegador envía OPTIONS antes de solicitudes complejas.
 * Esta validación responde correctamente al navegador.
 */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);  // Responder OK
    exit();                     // Terminar sin procesar más
}
