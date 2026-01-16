<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 15/01/2026
 */

// Comprobamos que el botón "volver" ha sido pulsado.
if(isset($_REQUEST['volver'])){
    // Si ha sido pulsado, le damos el valor de la página anterior.
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    header('Location: indexLoginLogoff.php');
    exit;
}

require_once $view['layout'];