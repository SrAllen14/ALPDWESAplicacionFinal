<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 30/01/2026
 */

// Comprobamos que la sesión ha sido iniciada.
if(empty($_SESSION['usuarioDWESLoginLogoff'])){
    // En caso de que no haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que hay un departamento guardado.
if(empty($_SESSION['departamentoActual'])){
    // En caso de que no haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'mtoDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si ha sido pulsado el botón "volver"
if(isset($_REQUEST['volver'])){
    // En caso de que no haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'mtoDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si ha sido pulsado el botón "cancelar"
if(isset($_REQUEST['bCancelar'])){
    // En caso de que no haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'mtoDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

$oDepartamento = $_SESSION['departamentoActual'];


$entradaOk = true;
$aErrores = [
    'descDepartamento' => null,
    'volumenNegocio' => null
];

if(isset($_REQUEST['bAplicar'])){
    $aErrores['descDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descDepartamento'], 255, 0, 1);
    $aErrores['volumenNegocio'] = validacionFormularios::comprobarFloatMonetarioES($_REQUEST['volumenNegocio'], 100000, -100000, 1);
    
    foreach($aErrores as $valor){
        if($valor != null){
            $entradaOk = false;
        }
    }
    
    if($entradaOk){
        $oDepartamento = DepartamentoPDO::modificaDepartamento($_SESSION['departamentoActual']->getCodDepartamento(), $_REQUEST['descDepartamento'], str_replace(',', '.', $_REQUEST['volumenNegocio']));
        $_SESSION['departamentoActual'] = $oDepartamento;
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'mtoDepartamento';
        header('Location: indexLoginLogoff.php');
        exit;
    }
}

$_SESSION['departamentoActual'] = $oDepartamento;
$accion = $_SESSION['accionDepartamento'];

$avEditarDepartamento = [
    'errores' => $aErrores,
    'codDepartamento' => $oDepartamento->getCodDepartamento(),
    'descDepartamento' => $oDepartamento->getDescDepartamento(),
    'fechaCreacionDepartamento' => ($oDepartamento) ? $oDepartamento->getFechaCreacionDepartamento()->format('Y-m-d') : null,
    'volumenNegocio' => number_format($oDepartamento->getVolumenNegocio(), 2, ',', '.'),
    'fechaBajaDepartamento' => ($oDepartamento->getFechaBajaDepartamento()) ? $oDepartamento->getFechaBajaDepartamento()->format('Y-m-d') : null,
    'accion' => $accion
];

require_once $view['layout'];
?>