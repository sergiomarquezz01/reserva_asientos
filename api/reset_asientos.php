<?php
require_once '../includes/db.php';
$pdo->query("UPDATE asientos SET estado = 'disponible', nombre_cliente = NULL");
echo json_encode(["status" => "success"]);