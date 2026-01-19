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

// Se obtiene la fecha de hoy para la foto del día de la Nasa.
$fechaHoy = new DateTime();
$fechaHoyFormateada = $fechaHoy->format('Y-m-d');

// Se llama a la api con la fecha formateada.
$oFotoNasa = REST::apiNasa($fechaHoyFormateada);


// Se crea un array con todos los datos que se le pasan a la vista.
$avRest = [
    'oFotoNasa' => $oFotoNasa
];

require_once $view['layout'];

?>