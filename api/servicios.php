<?php
/**
 * ========================================
 * api/servicios.php
 * ========================================
 * Endpoint: GET /api/servicios.php
 * 
 * Propósito:
 *   Obtener lista de todos los servicios disponibles
 * 
 * Parámetros:
 *   (ninguno)
 * 
 * Respuesta (JSON):
 *   {
 *     "success": true,
 *     "data": [
 *       {"id": 1, "nombre": "Corte", "precio": "300", "duracion": 30, ...},
 *       {"id": 2, "nombre": "Afeitado", "precio": "250", "duracion": 20, ...}
 *     ]
 *   }
 * 
 * Usado por:
 *   • Formulario de reserva (dropdown de servicios)
 *   • Dashboard (mostrar servicios ofrecidos)
 * ========================================
 */

require_once 'config.php';  // Importar configuración

// Establecer conexión a BD
$db = getDB();

// Consultar todos los servicios activos (activo=1)
// Ordenar por ID para mantener orden consistente
$res = $db->query("SELECT * FROM servicios WHERE activo=1 ORDER BY id");

// Acumular resultados en array
$data = [];
while ($r = $res->fetch_assoc()) {
    $data[] = $r;  // Agregar cada servicio al array
}

// Devolver respuesta JSON estándar
echo json_encode(['success' => true, 'data' => $data]);

// Cerrar conexión
$db->close();
