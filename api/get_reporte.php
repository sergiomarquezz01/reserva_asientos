<?php
header('Content-Type: application/json');
require_once '../includes/db.php';

try {
    // Obtenemos solo los asientos vendidos con su info
    $stmt = $pdo->query("SELECT id, fila, numero, nombre_cliente, ultima_actualizacion 
                         FROM asientos WHERE estado = 'vendido' 
                         ORDER BY ultima_actualizacion DESC");
    echo json_encode($stmt->fetchAll());
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}