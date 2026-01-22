<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 19/01/2026
 */

// Comprobamos si el botón "volver" ha sido pulsado.
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'rest';
    header('Location: indexLoginLogoff.php');
    exit;
}

$oFotoNasa = null;

if(isset($_SESSION['fotoNasa'])){
    $oFotoNasa = $_SESSION['fotoNasa'];
}

// Se crea un array con todos los datos que se le pasan a la vista.
$avRest = [
    'tituloNasa' => ($oFotoNasa) ? $oFotoNasa->getTitulo() : "No hay datos",
    'fotoNasaHD' => ($oFotoNasa) ? $oFotoNasa->getUrlHD() : "",
    'explicacionNasa' => ($oFotoNasa) ? $oFotoNasa->getExplicacion() : ""
];

require_once $view['layout'];

?>