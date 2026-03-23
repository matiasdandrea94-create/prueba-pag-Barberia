<?php
// =============================================
//  api/servicios.php — GET servicios activos
// =============================================
require_once 'config.php';
$db = getDB();
$res = $db->query("SELECT * FROM servicios WHERE activo=1 ORDER BY id");
$data = [];
while ($r = $res->fetch_assoc()) $data[] = $r;
echo json_encode(['success' => true, 'data' => $data]);
$db->close();
