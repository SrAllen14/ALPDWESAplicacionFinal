<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

// Comprobamos que la sesión ha sido iniciada.
if(empty($_SESSION['usuarioDWESLoginLogoff'])){
    // En caso de que no se haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "iniciar" ha sido pulsado.
if(isset($_REQUEST['detalles'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'detalles';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "error" ha sido pulsado.
if(isset($_REQUEST['error'])){
    // Si ha sido pulsado realizamos una consulta incorrecta a la base de datos para que nos salte un error.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $consultaError = "SELECT * FROM T03_Cuestion";
    DBPDO::ejecutaConsulta($consultaError);
    $_SESSION['paginaEnCurso'] = 'error';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "wip" ha sido pulsado.
if(isset($_REQUEST['wip'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si se ha pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'wip';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "cerrarS" ha sido pulsado.
if(isset($_REQUEST['cerrarS'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web.
require_once $view['layout'];
?>