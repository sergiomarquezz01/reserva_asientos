# 🎟️ Seat Reservation Engine - Full Stack Architecture

[![PHP Version](https://img.shields.io/badge/PHP-8.2-777bb4.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1.svg)](https://www.mysql.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-f7df1e.svg)](https://developer.mozilla.org/es/docs/Web/JavaScript)

Un motor de reserva de asientos interactivo de alto rendimiento diseñado para eventos en vivo. Esta solución implementa un flujo de datos asíncrono, persistencia relacional y una interfaz reactiva basada en vectores dinámicos.

## 🏗️ Arquitectura del Sistema

El sistema sigue un patrón de **Separación de Responsabilidades (SoC)**:

* **Core Engine (PHP/PDO):** Capa de backend robusta que gestiona la lógica de negocio y la integridad de los datos mediante transacciones atómicas.
* **Vectorial Interface (SVG + JS):** Renderizado de alto rendimiento en el cliente. En lugar de cargar imágenes pesadas, el mapa se construye mediante manipulación del DOM en el espacio de nombres de SVG.
* **RESTful API Design:** Comunicación desacoplada entre el cliente y el servidor mediante el intercambio de objetos JSON.

## 🚀 Características Técnicas

### 🛠️ Backend (Persistence Layer)
* **Transacciones Atómicas:** Uso de `beginTransaction()` y `commit()` para garantizar que la reserva de múltiples asientos sea exitosa en su totalidad o se revierta ante fallos (Atomicidad).
* **Prepared Statements:** Protección nativa contra inyecciones SQL (SQLi) mediante el uso de PDO.
* **Seeding Engine:** Script automatizado para la generación de coordenadas geométricas (X, Y) y estructuras de aforo.

### 🎨 Frontend (Client Side)
* **Async/Await Workflow:** Manejo de la asincronía para una experiencia de usuario fluida (SPA feeling).
* **Dynamic Tooltips:** Sistema de información contextual al vuelo para la identificación de filas y numeración.
* **Validación de Capas:** Sistema de control de estados (Disponible, Seleccionado, Vendido) sincronizado mediante ID únicos de base de datos.

## 📂 Estructura de Directorios

```text
├── api/                # Endpoints de servicio (JSON Interface)
│   ├── get_asientos.php
│   ├── reservar.php
│   └── get_reporte.php
├── assets/             # Recursos estáticos
│   ├── js/main.js      # Lógica reactiva del mapa
│   └── css/styles.css  # Diseño modular
├── includes/           # Lógica de negocio y conexión
│   └── db.php          # Singleton-like PDO connection
└── sql/                # Capa de datos (Esquemas y Seeds)
