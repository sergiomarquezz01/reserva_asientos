/**
 * PROYECTO: Sistema de Reservas Interactivo
 * ARCHIVO: assets/js/main.js
 */

const svgMapa = document.getElementById('mapa-asientos');
const contadorText = document.getElementById('num-asientos');
const btnConfirmar = document.getElementById('btn-confirmar');
const inputNombre = document.getElementById('nombre-cliente'); // El input que añadiste al index

let seleccionados = []; 

/**
 * 1. CARGAR MAPA: Obtiene los asientos de la base de datos y los dibuja
 */
async function renderizarMapa() {
    try {
        svgMapa.innerHTML = ''; // Limpiamos para evitar duplicados
        
        const response = await fetch('api/get_asientos.php');
        const asientos = await response.json();

        asientos.forEach(asiento => {
            const circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
            
            circle.setAttribute("cx", asiento.x);
            circle.setAttribute("cy", asiento.y);
            circle.setAttribute("r", "12");
            circle.setAttribute("id", `asiento-${asiento.id}`);
            
            // Clase CSS según el estado de la DB (disponible o vendido)
            circle.classList.add("asiento", asiento.estado);

            // Tooltip para ver fila y número al pasar el mouse
            const title = document.createElementNS("http://www.w3.org/2000/svg", "title");
            title.textContent = `Fila: ${asiento.fila} - Asiento: ${asiento.numero}`;
            circle.appendChild(title);

            // Evento de clic para seleccionar
            circle.onclick = () => toggleAsiento(asiento.id, circle);

            svgMapa.appendChild(circle);
        });
    } catch (error) {
        console.error("Error al cargar el mapa:", error);
    }
}

/**
 * 2. SELECCIÓN: Maneja el estado visual de los asientos elegidos
 */
function toggleAsiento(id, elemento) {
    if (elemento.classList.contains('vendido')) return; // No hacer nada si ya está ocupado

    if (elemento.classList.contains('seleccionado')) {
        elemento.classList.remove('seleccionado');
        seleccionados = seleccionados.filter(sid => sid !== id);
    } else {
        elemento.classList.add('seleccionado');
        seleccionados.push(id);
    }

    // Actualizamos el contador y el botón
    contadorText.innerText = seleccionados.length;
    btnConfirmar.disabled = (seleccionados.length === 0);
}

/**
 * 3. PROCESAR RESERVA: Envía los datos al servidor (WampServer)
 */
btnConfirmar.onclick = async () => {
    // Validamos que el usuario haya escrito su nombre
    const nombre = inputNombre.value.trim();
    if (!nombre) {
        alert("Por favor, ingresa tu nombre para la reserva.");
        inputNombre.focus();
        return;
    }

    btnConfirmar.disabled = true;
    btnConfirmar.innerText = "Procesando...";

    try {
        const response = await fetch('api/reservar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                asientos: seleccionados,
                nombre: nombre // Enviamos el nombre capturado
            })
        });

        const resultado = await response.json();

        if (resultado.status === 'success') {
            alert(`¡Reserva exitosa a nombre de: ${nombre}!`);
            
            // Limpiamos la selección y el formulario
            seleccionados = [];
            inputNombre.value = '';
            contadorText.innerText = '0';
            
            // Refrescamos el mapa para que salgan en rojo
            renderizarMapa();
        } else {
            alert("Error: " + resultado.message);
        }
    } catch (error) {
        console.error("Error en la petición:", error);
        alert("No se pudo conectar con el servidor.");
    } finally {
        btnConfirmar.innerText = "Confirmar Reserva";
        btnConfirmar.disabled = (seleccionados.length === 0);
    }
};

// Arrancamos el mapa al cargar la página
document.addEventListener('DOMContentLoaded', renderizarMapa);