# 🎟️ Sistema de Reservas de Asientos Interactivo

Este es un proyecto final de curso de **Desarrollo Web Full-Stack**. Consiste en una aplicación web interactiva que permite a los usuarios seleccionar y reservar asientos en tiempo real mediante un mapa visual dinámico.

## 🚀 Características Principales

* **Mapa Interactivo SVG:** Los asientos se renderizan dinámicamente utilizando vectores (SVG), lo que permite una interfaz ligera y escalable.
* **Gestión de Estados:** El sistema identifica tres estados: Disponible (Verde), Seleccionado (Azul) y Vendido (Rojo).
* **Comunicación Asíncrona:** Uso de la **Fetch API** de JavaScript para comunicarse con el servidor sin recargar la página.
* **Panel Administrativo:** Interfaz exclusiva para visualizar reportes de ventas, ver nombres de clientes y reiniciar el aforo.
* **Base de Datos Relacional:** Persistencia de datos mediante MySQL para asegurar que las reservas se mantengan tras refrescar la página.

## 🛠️ Tecnologías Utilizadas

* **Frontend:** HTML5, CSS3, JavaScript (ES6+).
* **Backend:** PHP 8.x.
* **Base de Datos:** MySQL / MariaDB.
* **Servidor Local:** Wampserver.

## 📂 Estructura del Proyecto

```text
reserva_asientos/
├── api/                 # Endpoints JSON (Backend)
├── assets/              # Archivos estáticos (CSS, JS)
├── includes/            # Configuración de base de datos (PDO)
├── sql/                 # Scripts de creación y "seeding"
├── index.php            # Vista del cliente
└── admin.php            # Panel del administrador