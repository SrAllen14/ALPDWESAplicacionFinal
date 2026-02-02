<?php
/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 30/01/2026
 */

// Comprobamos que la sesión ha sido iniciada.
if(empty($_SESSION['usuarioDWESLoginLogoff'])){
    // En caso de que no se haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que el botón "cancelar" ha sido pulsado.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'miCuenta';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que el botón "aceptar" ha sido pulsado.
if(isset($_REQUEST['aceptar'])){
    // En caso de aceptar borramos el usuario y comprobamos que se ha ejectado correctamente.
    if(UsuarioPDO::borrarUsuario($_SESSION['usuarioDWESLoginLogoff'])){
        // En caso de que funcionado correctamente volvemos a la pagina publica.
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header('Location: indexLoginLogoff.php');
        exit;
    }
}

require_once $view['layout'];
?>