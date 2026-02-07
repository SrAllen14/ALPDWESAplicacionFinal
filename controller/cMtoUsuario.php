<?php
/**
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 05/02/2026
 */

// Comprobamos si el botón "volver" ha sido pulsado.
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}

if(isset($_REQUEST['bVer'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'consultarUsuario';
    header('Location: indexLoginLogoff.php');
    exit;
}
if(isset($_REQUEST['bBorrar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'eliminarUsuario';
    header('Location: indexLoginLogoff.php');
    exit;
}

require_once $view['layout'];
?>