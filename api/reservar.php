<?php
header('Content-Type: application/json');
require_once '../includes/db.php';

// Leemos el cuerpo de la petición (JSON enviado por JS)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Verificamos que lleguen los datos necesarios
$asientos = $data['asientos'] ?? [];
$nombre = $data['nombre'] ?? 'Anónimo'; // Si no llega, ponemos Anónimo

if (empty($asientos)) {
    echo json_encode(['status' => 'error', 'message' => 'No seleccionaste asientos']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Preparamos la consulta para actualizar estado Y nombre del cliente
    $stmt = $pdo->prepare("UPDATE asientos SET estado = 'vendido', nombre_cliente = ? WHERE id = ? AND estado = 'disponible'");

    foreach ($asientos as $id) {
        $stmt->execute([$nombre, $id]);
    }

    $pdo->commit();
    echo json_encode(['status' => 'success', 'message' => 'Reserva guardada']);

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}