<?php
// =============================================
//  api/horarios.php
//  Devuelve horarios con estado libre/ocupado
//  GET ?barbero_id=1&fecha=2025-01-15
// =============================================
require_once 'config.php';
$db = getDB();

$barbero_id = (int)($_GET['barbero_id'] ?? 0);
$fecha      = $_GET['fecha'] ?? '';

if (!$barbero_id || !$fecha) {
    echo json_encode(['success' => false, 'error' => 'Faltan parámetros']);
    exit;
}

// Horarios disponibles (9:00 a 19:30, cada 30 min)
$todos = [
    '09:00','09:30','10:00','10:30','11:00','11:30',
    '12:00','12:30','13:00','14:00','14:30','15:00',
    '15:30','16:00','16:30','17:00','17:30','18:00',
    '18:30','19:00','19:30'
];

// Traer ocupados
$stmt = $db->prepare("SELECT TIME_FORMAT(horario,'%H:%i') as h FROM turnos WHERE barbero_id=? AND fecha=? AND estado != 'Cancelado'");
$stmt->bind_param('is', $barbero_id, $fecha);
$stmt->execute();
$res = $stmt->get_result();

$ocupados = [];
while ($r = $res->fetch_assoc()) $ocupados[] = $r['h'];

$horarios = array_map(fn($h) => [
    'horario' => $h,
    'disponible' => !in_array($h, $ocupados)
], $todos);

echo json_encode(['success' => true, 'data' => $horarios]);
$db->close();
