<?php

// Comprobamos que la sesión ha sido iniciada.
if (empty($_SESSION['usuarioDWESLoginLogoff'])) {
    // En caso de que no se haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si la sesión "fotoNasa" está vacia.
if (empty($_SESSION['fotoNasa'])) {
    // Se obtiene la fecha de hoy para valores.
    $fechaHoy = new DateTime();
    $fechaHoyFormateada = $fechaHoy->format('Y-m-d');
    $_SESSION['fotoNasa'] = REST::apiNasa($fechaHoyFormateada);
}

// Comprobamos si la sesión "fotoNasa" está vacia.
if (empty($_SESSION['oDepartamento'])) {
    // Se obtiene la fecha de hoy para valores.
    $_SESSION['oDepartamento'] = REST::apiDepartamentos();
}

// Comprobamos si el botón "detalles" ha sido pulsado.
if (isset($_REQUEST['detalles'])) {
    // Si ha sido pulsado el damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'detallesNasa';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "volver" ha sido pulsado.
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}

$fotoExiste = true;
$entradaOk = true;
// Inicializamos las variables de control.
$aErrores = [
    'fechaNasa' => null,
    'codDepartamento' => null
];

$oFotoNasa = null;

// Se obtiene la fecha de hoy para valores.
$fechaHoy = new DateTime();
$fechaHoyFormateada = $fechaHoy->format('Y-m-d');
$fechaNasa = $fechaHoyFormateada; // Fecha formateada del día de hoy.
// Comprobamos si el botón "btnFecha" ha sido pulsado.
if (isset($_REQUEST['btnFecha'])) {
    $aErrores['fechaNasa'] = validacionFormularios::validarFecha($_REQUEST['inFecha'], $fechaHoyFormateada, '1995-06-16', 1);

    if ($aErrores['fechaNasa'] != null) {
        $entradaOk = false;
    }

    if ($entradaOk) {
        $fechaNasa = $_REQUEST['inFecha'];
        $oFotoNasa = REST::apiNasa($fechaNasa);
        $_SESSION['fotoNasa'] = $oFotoNasa;        
    }
}

$oDepartamentoActual = null;

$entradaCodDptoOk = true;

if(isset($_REQUEST['btnCodDepartamento'])){
    $aErrores['codDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_POST['codDepartamento'], 3, 3, 0);
    
    if ($aErrores['codDepartamento'] != null) {
        $entradaCodDptoOk = false;
    }

    if ($entradaCodDptoOk) {
        $oDepartamentoActual = REST::apiDepartamentos($_POST['codDepartamento']);
        $_SESSION['oDepartamento'] = $oDepartamentoActual;
    }
}

// Se crea un array con todos los datos que se le pasan a la vista.
$avRest = [
    'tituloNasa' => $_SESSION['fotoNasa']->getTitulo(),
    'fotoNasa' => $_SESSION['fotoNasa']->getUrl(),
    'fotoNasaHD' => $_SESSION['fotoNasa']->getUrlHD(),
    'explicacionNasa' => $_SESSION['fotoNasa']->getExplicacion(),
    'fechaNasa' => $_SESSION['fotoNasa']->getFecha(),
    'errorNasa' => $_SESSION['fotoNasa']->getError(),
    'aCodDepartamentos' => DepartamentoPDO::obtenerTodosCodigosDepartamentos(),
    'codDepartamento' => $_SESSION['oDepartamento']->getCodDepartamento(),
    'descDepartamento' => $_SESSION['oDepartamento']->getDescDepartamento(),
    'fechaCreacionDepartamento' => $_SESSION['oDepartamento']->getFechaCreacionDepartamento(),
    'fechaBajaDepartamento' => $_SESSION['oDepartamento']->getFechaBajaDepartamento(),
    'volumenNegocio' => (number_format($_SESSION['oDepartamento']->getVolumenNegocio(), 2, ',', '.') . ' €')
];

require_once $view['layout'];