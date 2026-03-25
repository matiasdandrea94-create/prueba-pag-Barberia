<?php
/**
 * ========================================
 * api/turnos.php
 * ========================================
 * Endpoint: /api/turnos.php (CRUD completo)
 * 
 * Propósito:
 *   Gestionar todas las operaciones sobre turnos:
 *   • GET: listar turnos (con filtros opcionales)
 *   • POST: crear nuevo turno
 *   • PUT: actualizar estado de turno
 *   • DELETE: eliminar turno
 * 
 * Métodos soportados:
 *   • GET: lista filtrable por barbero, estado, fecha, búsqueda por nombre/teléfono
 *   • POST: crear turno, valida que no haya duplicados de horario
 *   • PUT: cambiar estado (Pendiente/Realizado/Cancelado)
 *   • DELETE: eliminar turno por ID
 * 
 * Estados de turno permitidos:
 *   • "Pendiente" - Turno confirmado pero no realizado
 *   • "Realizado" - Servicio ya completado
 *   • "Cancelado" - Turno anulado
 * ========================================
 */

require_once 'config.php';

// Obtener método HTTP de la solicitud (GET, POST, PUT, DELETE, OPTIONS)
$method = $_SERVER['REQUEST_METHOD'];
$db = getDB();

/**
 * ════════════════════════════════════════════════════════════════
 * GET: LISTAR TURNOS CON FILTROS
 * ════════════════════════════════════════════════════════════════
 * Parámetros GET opcionales:
 *   • barbero_id (int): Filtrar por ID de barbero
 *   • estado (string): Filtrar por estado (Pendiente/Realizado/Cancelado)
 *   • fecha (string): Filtrar por fecha exacta (YYYY-MM-DD)
 *   • busqueda (string): Buscar por nombre o teléfono del cliente
 * 
 * Ejemplo: /api/turnos.php?barbero_id=1&estado=Pendiente&fecha=2025-03-25
 */
if ($method === 'GET') {
    $where = ['1=1'];
    $params = [];
    $types  = '';

    if (!empty($_GET['barbero_id'])) {
        $where[] = 't.barbero_id = ?';
        $params[] = (int)$_GET['barbero_id'];
        $types .= 'i';
    }
    if (!empty($_GET['estado'])) {
        $where[] = 't.estado = ?';
        $params[] = $_GET['estado'];
        $types .= 's';
    }
    if (!empty($_GET['fecha'])) {
        $where[] = 't.fecha = ?';
        $params[] = $_GET['fecha'];
        $types .= 's';
    }
    if (!empty($_GET['busqueda'])) {
        $where[] = '(t.nombre LIKE ? OR t.telefono LIKE ?)';
        $like = '%' . $_GET['busqueda'] . '%';
        $params[] = $like;
        $params[] = $like;
        $types .= 'ss';
    }

    $sql = "SELECT t.id, t.nombre, t.telefono,
                   b.nombre AS barbero, b.id AS barbero_id,
                   s.nombre AS servicio, s.id AS servicio_id,
                   s.precio, s.duracion,
                   t.fecha, t.horario, t.estado, t.notas, t.created_at
            FROM turnos t
            JOIN barberos b  ON t.barbero_id  = b.id
            JOIN servicios s ON t.servicio_id = s.id
            WHERE " . implode(' AND ', $where) . "
            ORDER BY t.fecha DESC, t.horario ASC";

    $stmt = $db->prepare($sql);
    if ($types) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $turnos = [];
    while ($row = $result->fetch_assoc()) {
        $row['fecha']   = $row['fecha'];   // ya viene como string YYYY-MM-DD
        $row['horario'] = substr($row['horario'], 0, 5); // HH:MM
        $turnos[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $turnos]);
}

// ── POST: crear turno ───────────────────────────────────────
elseif ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);

    $nombre      = trim($body['nombre'] ?? '');
    $telefono    = trim($body['telefono'] ?? '');
    $barbero_id  = (int)($body['barbero_id'] ?? 0);
    $servicio_id = (int)($body['servicio_id'] ?? 0);
    $fecha       = $body['fecha'] ?? '';
    $horario     = $body['horario'] ?? '';
    $notas       = trim($body['notas'] ?? '');

    // Validaciones
    if (!$nombre || !$barbero_id || !$servicio_id || !$fecha || !$horario) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Faltan campos obligatorios']);
        exit;
    }

    // Verificar que el horario no esté ocupado
    $check = $db->prepare("SELECT id FROM turnos WHERE barbero_id=? AND fecha=? AND horario=? AND estado != 'Cancelado'");
    $check->bind_param('iss', $barbero_id, $fecha, $horario);
    $check->execute();
    if ($check->get_result()->num_rows > 0) {
        http_response_code(409);
        echo json_encode(['success' => false, 'error' => 'Ese horario ya está ocupado']);
        exit;
    }

    $stmt = $db->prepare("INSERT INTO turnos (nombre, telefono, barbero_id, servicio_id, fecha, horario, notas) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param('ssiiiss', $nombre, $telefono, $barbero_id, $servicio_id, $fecha, $horario, $notas);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $stmt->insert_id, 'message' => 'Turno reservado']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al guardar el turno']);
    }
}

// ── PUT: actualizar estado ──────────────────────────────────
elseif ($method === 'PUT') {
    $body = json_decode(file_get_contents('php://input'), true);
    $id     = (int)($body['id'] ?? 0);
    $estado = $body['estado'] ?? '';

    if (!$id || !in_array($estado, ['Pendiente','Realizado','Cancelado'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
        exit;
    }

    $stmt = $db->prepare("UPDATE turnos SET estado=? WHERE id=?");
    $stmt->bind_param('si', $estado, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Estado actualizado']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al actualizar']);
    }
}

// ── DELETE: eliminar turno ──────────────────────────────────
elseif ($method === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'ID inválido']);
        exit;
    }
    $stmt = $db->prepare("DELETE FROM turnos WHERE id=?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Turno eliminado']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al eliminar']);
    }
}

$db->close();
