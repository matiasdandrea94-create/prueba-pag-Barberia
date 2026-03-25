<?php
/**
 * ========================================
 * api/config.php (VERSIÓN MEJORADA)
 * ========================================
 * Cambios:
 * ✓ CORS restringido por dominio
 * ✓ Credenciales desde variables de entorno
 * ✓ Manejo de errores mejorado
 * ✓ Headers de seguridad adicionales
 * ========================================
 */

// ────────────────────────────────────────────────────────
// CONFIGURACIÓN DE BASE DE DATOS
// ────────────────────────────────────────────────────────
// En PRODUCCIÓN, usar archivo .env con variables de entorno
// En DESARROLLO, usar valores por defecto

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'barberia');
define('DB_PORT', getenv('DB_PORT') ?: 3306);

// ────────────────────────────────────────────────────────
// MODO DEBUG (desactivar en producción)
// ────────────────────────────────────────────────────────
define('DEBUG', getenv('DEBUG') === 'true' ? true : false);

// ────────────────────────────────────────────────────────
// DOMINIO PERMITIDO PARA CORS
// ────────────────────────────────────────────────────────
$allowed_origins = [
    'http://localhost',
    'http://localhost:8000',
    'http://127.0.0.1',
    'http://localhost:3000',  // Si usas servidor de desarrollo
];

// En producción, agregar dominio real
if (!DEBUG) {
    $allowed_origins = [
        'https://barberia.com.ar',
        'https://admin.barberia.com.ar',
    ];
}

/**
 * Función para obtener conexión a la base de datos
 * 
 * @return mysqli Objeto de conexión
 * @throws Exception Si la conexión falla
 */
function getDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    if ($conn->connect_error) {
        http_response_code(500);
        die(json_encode([
            'success' => false,
            'error' => 'Error de conexión a la base de datos',
            'debug' => DEBUG ? 'Conexión rechazada: ' . $conn->connect_error : null
        ]));
    }
    
    // Configurar charset UTF-8
    $conn->set_charset('utf8mb4');
    
    // Establecer timeout
    $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
    
    return $conn;
}

// ────────────────────────────────────────────────────────
// CONFIGURACIÓN DE RESPONSES
// ────────────────────────────────────────────────────────
header('Content-Type: application/json; charset=utf-8');

// Headers de seguridad adicionales
header('X-Content-Type-Options: nosniff');           // Evita MIME sniffing
header('X-Frame-Options: DENY');                     // Evita clickjacking
header('X-XSS-Protection: 1; mode=block');           // Protección XSS (navegadores antiguos)
header('Strict-Transport-Security: max-age=31536000; includeSubDomains'); // HTTPS

// ────────────────────────────────────────────────────────
// CORS CON RESTRICCIÓN POR DOMINIO
// ────────────────────────────────────────────────────────
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origin, $allowed_origins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Max-Age: 3600');  // Cache preflight por 1 hora
} else {
    // ORIGIN no permitido - no enviar Access-Control-Allow-Origin
    // El navegador bloqueará la solicitud automáticamente
}

// ────────────────────────────────────────────────────────
// VALIDACIÓN DE SOLICITUDES PREFLIGHT (OPTIONS)
// ────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// ────────────────────────────────────────────────────────
// HELPERS PARA RESPUESTAS JSON
// ────────────────────────────────────────────────────────

/**
 * Enviar respuesta JSON de éxito
 */
function json_success($data = null, $message = null) {
    echo json_encode([
        'success' => true,
        'data' => $data,
        'message' => $message
    ]);
    exit;
}

/**
 * Enviar respuesta JSON de error
 */
function json_error($message, $code = 400, $debug = null) {
    http_response_code($code);
    echo json_encode([
        'success' => false,
        'error' => $message,
        'code' => $code,
        'debug' => (DEBUG && $debug) ? $debug : null
    ]);
    exit;
}
