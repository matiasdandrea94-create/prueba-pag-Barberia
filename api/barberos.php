<?php
/**
 * ========================================
 * api/barberos.php
 * ========================================
 * Endpoint: GET /api/barberos.php
 * 
 * Propósito:
 *   Obtener lista de todos los barberos activos
 * 
 * Parámetros:
 *   (ninguno)
 * 
 * Respuesta (JSON):
 *   {
 *     "success": true,
 *     "data": [
 *       {"id": 1, "nombre": "Juan", "activo": 1, ...},
 *       {"id": 2, "nombre": "Carlos", "activo": 1, ...}
 *     ]
 *   }
 * 
 * Usado por:
 *   • Formulario de reserva (dropdown de barberos)
 *   • Dashboard (listado de barberos)
 * ========================================
 */

require_once 'config.php';  // Importar configuración y función getDB()

// Establecer conexión a la BD
$db = getDB();

// Consultar todos los barberos cuyo estado sea activo (activo=1)
// Ordenar alfabéticamente por nombre para mejor UX
$res = $db->query("SELECT * FROM barberos WHERE activo=1 ORDER BY nombre");

// Acumular resultados en array
$data = [];
while ($r = $res->fetch_assoc()) {
    $data[] = $r;  // Agregar cada barbero al array
}

// Devolver respuesta en formato JSON con estructura estándar
echo json_encode(['success' => true, 'data' => $data]);

// Cerrar conexión a BD
$db->close();
