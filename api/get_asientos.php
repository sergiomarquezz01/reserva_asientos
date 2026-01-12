<?php
// api/get_asientos.php
header('Content-Type: application/json');
require_once '../includes/db.php';

try {
    $evento_id = 1; // Por ahora estático para pruebas
    $stmt = $pdo->prepare("SELECT id, fila, numero, x, y, estado FROM asientos WHERE evento_id = ?");
    $stmt->execute([$evento_id]);
    $asientos = $stmt->fetchAll();

    echo json_encode($asientos);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}