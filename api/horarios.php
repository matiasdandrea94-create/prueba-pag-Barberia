<?php
/**
 * ========================================
 * api/horarios.php
 * ========================================
 * Endpoint: GET /api/horarios.php?barbero_id=X&fecha=YYYY-MM-DD
 * 
 * Propósito:
 *   Obtener todos los horarios disponibles para un barbero en una fecha
 *   Indica cuáles están libres y cuáles ocupados
 * 
 * Parámetros GET requeridos:
 *   • barbero_id (int): ID del barbero
 *   • fecha (string): Fecha en formato YYYY-MM-DD
 * 
 * Respuesta (JSON):
 *   {
 *     "success": true,
 *     "data": [
 *       {"horario": "09:00", "disponible": true},
 *       {"horario": "09:30", "disponible": false},
 *       ...
 *     ]
 *   }
 * 
 * Usado por:
 *   • Formulario de reserva (mostrar horarios disponibles)
 * ========================================
 */

require_once 'config.php';

// Establecer conexión
$db = getDB();

// ──────────────────────────────────────────────
// Obtener parámetros de la solicitud
// ──────────────────────────────────────────────
$barbero_id = (int)($_GET['barbero_id'] ?? 0);  // ID del barbero (validar que sea número)
$fecha      = $_GET['fecha'] ?? '';             // Fecha solicitada

// Validar que ambos parámetros estén presentes
if (!$barbero_id || !$fecha) {
    echo json_encode(['success' => false, 'error' => 'Faltan parámetros: barbero_id y fecha son obligatorios']);
    exit;
}

// ──────────────────────────────────────────────
// Definir horarios disponibles
// ──────────────────────────────────────────────
// Rango de atención: 9:00 a 19:30, cada 30 minutos
// Total de 21 franjas horarias
$todos = [
    '09:00','09:30','10:00','10:30','11:00','11:30',
    '12:00','12:30','13:00','14:00','14:30','15:00',
    '15:30','16:00','16:30','17:00','17:30','18:00',
    '18:30','19:00','19:30'
];

// ──────────────────────────────────────────────
// Obtener horarios ocupados desde BD
// ──────────────────────────────────────────────
// Usar prepared statement para evitar inyección SQL
$stmt = $db->prepare(
    "SELECT TIME_FORMAT(horario,'%H:%i') as h 
     FROM turnos 
     WHERE barbero_id = ? 
       AND fecha = ? 
       AND estado != 'Cancelado'"  // Ignorar turnos cancelados
);

// Vincular parámetros con tipos (i=int, s=string)
$stmt->bind_param('is', $barbero_id, $fecha);
$stmt->execute();
$res = $stmt->get_result();

// Acumular horarios ocupados en array
$ocupados = [];
while ($r = $res->fetch_assoc()) {
    $ocupados[] = $r['h'];  // Agregar horario ocupado
}

// ──────────────────────────────────────────────
// Construir respuesta con disponibilidad
// ──────────────────────────────────────────────
// Mapear cada horario del día con su estado de disponibilidad
$horarios = array_map(fn($h) => [
    'horario' => $h,
    'disponible' => !in_array($h, $ocupados)  // true si NO está en ocupados
], $todos);

// Devolver resultado en JSON
echo json_encode(['success' => true, 'data' => $horarios]);

// Cerrar conexión
$db->close();
