<?php
/**
 * ========================================
 * api/validators.php
 * ========================================
 * Funciones centralizadas de validación
 * para garantizar consistencia y seguridad
 * ========================================
 */

/**
 * Validar nombre de cliente (solo letras, espacios, acentos)
 * @param string $nombre
 * @return array ['valid' => bool, 'error' => string|null]
 */
function validar_nombre($nombre) {
    $nombre = trim($nombre ?? '');
    
    if (empty($nombre)) {
        return ['valid' => false, 'error' => 'El nombre es obligatorio'];
    }
    
    if (strlen($nombre) < 2) {
        return ['valid' => false, 'error' => 'El nombre debe tener al menos 2 caracteres'];
    }
    
    if (strlen($nombre) > 100) {
        return ['valid' => false, 'error' => 'El nombre no puede exceder 100 caracteres'];
    }
    
    // Solo letras, espacios, acentos (sin números ni caracteres especiales)
    if (!preg_match('/^[a-záéíóúñ\s\-\']+$/i', $nombre)) {
        return ['valid' => false, 'error' => 'El nombre contiene caracteres inválidos'];
    }
    
    return ['valid' => true, 'error' => null];
}

/**
 * Validar teléfono (Argentina: 10-15 dígitos con formato flexible)
 * @param string $telefono
 * @return array ['valid' => bool, 'error' => string|null]
 */
function validar_telefono($telefono) {
    $telefono = trim($telefono ?? '');
    
    if (empty($telefono)) {
        return ['valid' => false, 'error' => 'El teléfono es obligatorio'];
    }
    
    // Extraer solo dígitos
    $digitos = preg_replace('/[^0-9]/', '', $telefono);
    
    if (strlen($digitos) < 10 || strlen($digitos) > 15) {
        return ['valid' => false, 'error' => 'Teléfono inválido (debe tener 10-15 dígitos)'];
    }
    
    // Si es Argentina, puede empezar con +54 o 0
    if (strlen($digitos) > 2) {
        return ['valid' => true, 'error' => null];
    }
    
    return ['valid' => false, 'error' => 'Formato de teléfono no válido'];
}

/**
 * Validar fecha (debe ser futura y en formato YYYY-MM-DD)
 * @param string $fecha
 * @param bool $permitir_pasado (solo para admin)
 * @return array ['valid' => bool, 'error' => string|null]
 */
function validar_fecha($fecha, $permitir_pasado = false) {
    if (empty($fecha)) {
        return ['valid' => false, 'error' => 'La fecha es obligatoria'];
    }
    
    // Validar formato YYYY-MM-DD
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        return ['valid' => false, 'error' => 'Formato de fecha inválido (debe ser YYYY-MM-DD)'];
    }
    
    // Validar que sea una fecha real
    $d = DateTime::createFromFormat('Y-m-d', $fecha);
    if (!$d || $d->format('Y-m-d') !== $fecha) {
        return ['valid' => false, 'error' => 'Fecha inválida'];
    }
    
    // Validar que sea futura (para reservas de clientes)
    if (!$permitir_pasado) {
        $hoy = new DateTime('today');
        if ($d < $hoy) {
            return ['valid' => false, 'error' => 'No puedes reservar en fechas pasadas'];
        }
        
        // Máximo 90 días en el futuro
        $maximo = new DateTime('today');
        $maximo->modify('+90 days');
        if ($d > $maximo) {
            return ['valid' => false, 'error' => 'El máximo de días adelantados es 90'];
        }
    }
    
    return ['valid' => true, 'error' => null];
}

/**
 * Validar horario (formato HH:MM)
 * @param string $horario
 * @return array ['valid' => bool, 'error' => string|null]
 */
function validar_horario($horario) {
    if (empty($horario)) {
        return ['valid' => false, 'error' => 'El horario es obligatorio'];
    }
    
    // Validar formato HH:MM
    if (!preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/', $horario)) {
        return ['valid' => false, 'error' => 'Formato de horario inválido (debe ser HH:MM)'];
    }
    
    // Validar que esté dentro del rango permitido (09:00 - 19:30)
    $hora_inicio = strtotime('09:00');
    $hora_fin = strtotime('19:30');
    $hora_solicitada = strtotime($horario);
    
    if ($hora_solicitada < $hora_inicio || $hora_solicitada > $hora_fin) {
        return ['valid' => false, 'error' => 'El horario debe estar entre 09:00 y 19:30'];
    }
    
    // Validar que sea múltiplo de 30 minutos
    $minutos = intval(date('i', $hora_solicitada));
    if ($minutos % 30 !== 0) {
        return ['valid' => false, 'error' => 'El horario debe ser cada 30 minutos'];
    }
    
    return ['valid' => true, 'error' => null];
}

/**
 * Validar que un ID es un entero válido
 * @param mixed $id
 * @param string $nombre (para mensajes de error)
 * @return array ['valid' => bool, 'error' => string|null]
 */
function validar_id($id, $nombre = 'ID') {
    $id = intval($id ?? 0);
    
    if ($id <= 0) {
        return ['valid' => false, 'error' => $nombre . ' inválido'];
    }
    
    return ['valid' => true, 'error' => null, 'id' => $id];
}

/**
 * Validar estado de turno
 * @param string $estado
 * @return array ['valid' => bool, 'error' => string|null]
 */
function validar_estado($estado) {
    $estados_permitidos = ['Pendiente', 'Realizado', 'Cancelado'];
    
    if (!in_array($estado, $estados_permitidos)) {
        return [
            'valid' => false,
            'error' => 'Estado inválido. Debe ser: ' . implode(', ', $estados_permitidos)
        ];
    }
    
    return ['valid' => true, 'error' => null];
}

/**
 * Sanitizar string para evitar XSS
 * @param string $texto
 * @return string
 */
function sanitizar($texto) {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Validar JSON valid
 * @param string $json
 * @return array ['valid' => bool, 'error' => string|null, 'data' => array|null]
 */
function validar_json($json) {
    $data = json_decode($json, true);
    
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        return [
            'valid' => false,
            'error' => 'JSON inválido: ' . json_last_error_msg(),
            'data' => null
        ];
    }
    
    return ['valid' => true, 'error' => null, 'data' => $data];
}
