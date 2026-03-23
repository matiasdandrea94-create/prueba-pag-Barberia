<?php
// =============================================
//  api/stats.php — Estadísticas del dashboard
// =============================================
require_once 'config.php';
$db = getDB();

$hoy = date('Y-m-d');

$stats = [];

// Turnos hoy
$r = $db->query("SELECT COUNT(*) as c FROM turnos WHERE fecha='$hoy' AND estado != 'Cancelado'");
$stats['turnos_hoy'] = $r->fetch_assoc()['c'];

// Total reservados
$r = $db->query("SELECT COUNT(*) as c FROM turnos WHERE estado != 'Cancelado'");
$stats['total'] = $r->fetch_assoc()['c'];

// Pendientes
$r = $db->query("SELECT COUNT(*) as c FROM turnos WHERE estado='Pendiente'");
$stats['pendientes'] = $r->fetch_assoc()['c'];

// Por barbero
$r = $db->query("SELECT b.nombre, COUNT(t.id) as total,
    SUM(CASE WHEN t.estado='Realizado' THEN 1 ELSE 0 END) as realizados
    FROM barberos b LEFT JOIN turnos t ON b.id=t.barbero_id
    WHERE b.activo=1 GROUP BY b.id ORDER BY b.nombre");
$stats['por_barbero'] = [];
while ($row = $r->fetch_assoc()) $stats['por_barbero'][] = $row;

// Servicio más popular
$r = $db->query("SELECT s.nombre, COUNT(t.id) as veces
    FROM servicios s LEFT JOIN turnos t ON s.id=t.servicio_id
    GROUP BY s.id ORDER BY veces DESC LIMIT 5");
$stats['servicios_top'] = [];
while ($row = $r->fetch_assoc()) $stats['servicios_top'][] = $row;

echo json_encode(['success' => true, 'data' => $stats]);
$db->close();
