<?php
/*
 * @author: Álvaro Allén Perlines
 * @since: 15/12/2025
 */

// Incluir la configuración de la app y de la DB.
require_once 'config/confAPP.php';
require_once 'config/confDBPDO.php';

// Recuperar la sesión.
session_start();

// Comprobar si hay una página activa.
if(!isset($_SESSION['paginaEnCurso'])){
    // Asigna como página activa el inicioPublico en caso de no haberla.
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
}

// Cargar en el controlador la página en curso actual
require_once $controller[$_SESSION['paginaEnCurso']];
?>