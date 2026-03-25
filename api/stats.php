<?php
/**
 * ========================================
 * api/stats.php
 * ========================================
 * Endpoint: GET /api/stats.php
 * 
 * Propósito:
 *   Obtener estadísticas y métricas para el dashboard
 *   Proporciona información agregada sobre desempeño de la barbería
 * 
 * Parámetros:
 *   (ninguno)
 * 
 * Respuesta (JSON estructura):
 *   {
 *     "success": true,
 *     "data": {
 *       "turnos_hoy": 5,
 *       "total": 42,
 *       "pendientes": 8,
 *       "por_barbero": [...],
 *       "servicios_top": [...]
 *     }
 *   }
 * 
 * Usado por:
 *   • Dashboard de administrador (mostrar KPIs)
 *   • Reportes de desempeño
 * ========================================
 */

require_once 'config.php';

// Establecer conexión
$db = getDB();

// Obtener fecha de hoy para filtros
$hoy = date('Y-m-d');

// Array para acumular todas las estadísticas
$stats = [];

// ──────────────────────────────────────────────
// 1. Turnos programados para hoy
// ──────────────────────────────────────────────
// Contar turnos confirmados de hoy (sin cancelados)
$r = $db->query("SELECT COUNT(*) as c FROM turnos WHERE fecha='$hoy' AND estado != 'Cancelado'");
$stats['turnos_hoy'] = $r->fetch_assoc()['c'];

// ──────────────────────────────────────────────
// 2. Total de reservas (excluir canceladas)
// ──────────────────────────────────────────────
// Contar todos los turnos activos en el sistema
$r = $db->query("SELECT COUNT(*) as c FROM turnos WHERE estado != 'Cancelado'");
$stats['total'] = $r->fetch_assoc()['c'];

// ──────────────────────────────────────────────
// 3. Turnos en estado Pendiente
// ──────────────────────────────────────────────
// Contar turnos que aún no han sido realizados
$r = $db->query("SELECT COUNT(*) as c FROM turnos WHERE estado='Pendiente'");
$stats['pendientes'] = $r->fetch_assoc()['c'];

// ──────────────────────────────────────────────
// 4. Estadísticas por barbero
// ──────────────────────────────────────────────
// Mostrar total de turnos y realizados para cada barbero
// LEFT JOIN para incluir barberos sin turnos también
$r = $db->query(
    "SELECT b.nombre, 
            COUNT(t.id) as total,
            SUM(CASE WHEN t.estado='Realizado' THEN 1 ELSE 0 END) as realizados
     FROM barberos b 
     LEFT JOIN turnos t ON b.id=t.barbero_id
     WHERE b.activo=1 
     GROUP BY b.id 
     ORDER BY b.nombre"
);

// Acumular resultados
$stats['por_barbero'] = [];
while ($row = $r->fetch_assoc()) {
    $stats['por_barbero'][] = $row;
}

// ──────────────────────────────────────────────
// 5. Top 5 servicios más populares
// ──────────────────────────────────────────────
// Contar cuántas veces cada servicio fue reservado
// Ordenar descendentemente por cantidad de veces
$r = $db->query(
    "SELECT s.nombre, 
            COUNT(t.id) as veces
     FROM servicios s 
     LEFT JOIN turnos t ON s.id=t.servicio_id
     GROUP BY s.id 
     ORDER BY veces DESC 
     LIMIT 5"
);

// Acumular resultados
$stats['servicios_top'] = [];
while ($row = $r->fetch_assoc()) {
    $stats['servicios_top'][] = $row;
}

// ──────────────────────────────────────────────
// Devolver respuesta
// ──────────────────────────────────────────────
echo json_encode(['success' => true, 'data' => $stats]);

// Cerrar conexión
$db->close();
