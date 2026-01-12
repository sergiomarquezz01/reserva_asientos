<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Asientos Pro</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <div class="container">
        <h1>Selecciona tus asientos</h1>
        
        <div class="pantalla">PANTALLA / ESCENARIO</div>

        <div class="mapa-container">
            <svg id="mapa-asientos" viewBox="0 0 500 300" preserveAspectRatio="xMidYMid meet">
                </svg>
        </div>

        <div id="leyenda">
            <span class="item"><div class="bolita disponible"></div> Disponible</span>
            <span class="item"><div class="bolita seleccionado"></div> Tu selección</span>
            <span class="item"><div class="bolita vendido"></div> Ocupado</span>
        </div>

       <div id="footer-reserva">
            <input type="text" id="nombre-cliente" placeholder="Tu nombre completo" style="padding: 8px; margin-bottom: 10px;">
            <p>Has seleccionado <span id="num-asientos">0</span> asientos.</p>
            <button id="btn-confirmar" disabled>Confirmar Reserva</button>
        </div>

    <script src="assets/js/api.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>