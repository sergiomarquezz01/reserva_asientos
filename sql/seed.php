<?php
require_once '../includes/db.php';

// Supongamos que el evento ID es 1
$evento_id = 1;
$filas = ['A', 'B', 'C', 'D', 'E'];
$columnas = 10;

$asientos_insertados = 0;

foreach ($filas as $indiceFila => $letraFila) {
    for ($col = 1; $col <= $columnas; $col++) {
        // Calculamos coordenadas X e Y para el SVG
        $x = $col * 40; 
        $y = ($indiceFila + 1) * 50;

        $sql = "INSERT INTO asientos (evento_id, fila, numero, x, y, estado) 
                VALUES (?, ?, ?, ?, ?, 'disponible')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$evento_id, $letraFila, $col, $x, $y]);
        $asientos_insertados++;
    }
}

echo "Se han generado $asientos_insertados asientos correctamente.";
?>