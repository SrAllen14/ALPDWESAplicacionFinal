<?php

/*
 * @author: Álvaro Allén
 * @since: 10/01/2026
 */

// Si se pulsa el botón de login.
if(isset($_REQUEST['login'])){
    // Guardamos en la variable "pagina en curso" de la sesión la página a la que queremos dirigirnos.
    $_SESSION['paginaEnCurso'] = 'login';
    // Guardamos está pagina en la variable "paginaAnterior" de la sesion.
    header('Location: indexLoginLogoff.php');
    exit;
}

// Mostramos la vista.
require_once $view['layout'];
?>