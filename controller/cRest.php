<?php

// Comprobamos que la sesión ha sido iniciada.
if(empty($_SESSION['usuarioDWESLoginLogoff'])){
    // En caso de que no se haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "detalles" ha sido pulsado.
if(isset($_REQUEST['detalles'])){
    // Si ha sido pulsado el damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'detallesNasa';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "volver" ha sido pulsado.
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Inicializamos las variables de control.
$aErrores = [
    'fechaNasa' => null
];
$oFotoNasa = null;

// Se obtiene la fecha de hoy para valores.
$fechaHoy = new DateTime();
$fechaHoyFormateada = $fechaHoy->format('Y-m-d');
$fechaNasa = $fechaHoyFormateada; // Fecha formateada del día de hoy.

// Comprobamos si el botón "btnFecha" ha sido pulsado.
if(isset($_REQUEST['btnFecha'])){
    $entradaOk = true;
    $aErrores['fechaNasa'] = validacionFormularios::validarFecha($_REQUEST['inFecha'], $fechaHoyFormateada, '1995-06-16', 1);
    
    if($aErrores['fechaNasa'] != null){
        $entradaOk = false;
    }
    
    if($entradaOk){
        $fechaNasa = $_REQUEST['inFecha'];  
    }
}
$oFotoNasa = REST::apiNasa($fechaNasa);
$cookieFotoNasa = json_encode([
    'titulo' => $oFotoNasa->getTitulo(),
    'url' => $oFotoNasa->getUrl(),
    'fecha' => $oFotoNasa->getFecha(),
    'explicacion' => $oFotoNasa->getExplicacion()
]);
setcookie("fotoNasa", $cookieFotoNasa);

// Se crea un array con todos los datos que se le pasan a la vista.
$avRest = [
    'tituloNasa' => ($oFotoNasa) ? $oFotoNasa->getTitulo() : "No hay datos",
    'fotoNasa' => ($oFotoNasa) ? $oFotoNasa->getUrl() : "",
    'explicacionNasa' => ($oFotoNasa) ? $oFotoNasa->getExplicacion() : "",
    'errorNasa' => $aErrores['fechaNasa']
];

require_once $view['layout'];