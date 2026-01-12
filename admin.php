<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - Reservas</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .admin-container { max-width: 900px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background-color: #f8f9fa; color: #333; }
        .status-badge { padding: 4px 8px; border-radius: 4px; font-size: 0.85em; background: #ffebeb; color: #e74c3c; }
        .btn-danger { background: #e74c3c; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; float: right; }
    </style>
</head>
<body>
    <div class="admin-container">
        <button class="btn-danger" onclick="resetearSistema()">Reiniciar Todo el Teatro</button>
        <h1>Panel de Ventas Realizadas</h1>
        
        <table id="tabla-reporte">
            <thead>
                <tr>
                    <th>Asiento</th>
                    <th>Fila</th>
                    <th>Cliente</th>
                    <th>Fecha y Hora</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="lista-ventas">
                </tbody>
        </table>
        <p><a href="index.php">← Volver al Mapa de Clientes</a></p>
    </div>

    <script>
        async function cargarVentas() {
            const res = await fetch('api/get_reporte.php');
            const ventas = await res.json();
            const tabla = document.getElementById('lista-ventas');
            
            tabla.innerHTML = ventas.length ? ventas.map(v => `
                <tr>
                    <td><strong>${v.numero}</strong></td>
                    <td>${v.fila}</td>
                    <td>${v.nombre_cliente || 'Sin nombre'}</td>
                    <td>${v.ultima_actualizacion}</td>
                    <td><span class="status-badge">Vendido</span></td>
                </tr>
            `).join('') : '<tr><td colspan="5" style="text-align:center">No hay ventas registradas aún.</td></tr>';
        }

        async function resetearSistema() {
            if (confirm("¿BORRAR TODAS LAS VENTAS? Esta acción no se puede deshacer.")) {
                const res = await fetch('api/reset_asientos.php');
                const data = await res.json();
                if(data.status === 'success') location.reload();
            }
        }

        window.onload = cargarVentas;
    </script>
</body>
</html>