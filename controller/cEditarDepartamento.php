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
    $_SESSION['paginaEnCurso'] = 'departamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si ha sido pulsado el botón "volver"
if(isset($_REQUEST['volver'])){
    // En caso de que no haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'departamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

$oDepartamento = $_SESSION['departamentoActual'];


if(isset($_REQUEST['baja'])){
    $oDepartamento = DepartamentoPDO::bajaLogicaDepartamento($_SESSION['departamentoActual']);
    $_SESSION['departamentoActual'] = $oDepartamento;
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'editarDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

if(isset($_REQUEST['alta'])){
    $oDepartamento = DepartamentoPDO::rehabilitaDepartamento($_SESSION['departamentoActual']);
    $_SESSION['departamentoActual'] = $oDepartamento;
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'editarDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

$entradaOk = true;
$aErrores = [
    'descDepartamento' => null,
    'volumenNegocio' => null
];

if(isset($_REQUEST['bAplicar'])){
    $aErrores['descDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descDepartamento'], 255, 0, 1);
    $aErrores['volumenNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['volumenNegocio'], PHP_FLOAT_MAX, PHP_FLOAT_MIN, 1);
    
    foreach($aErrores as $valor){
        if($valor != null){
            $entradaOk = false;
            echo "hola";
        }
    }
    
    if($entradaOk){
        $oDepartamento = DepartamentoPDO::modificaDepartamento($_SESSION['departamentoActual'], $_REQUEST['descDepartamento'], $_REQUEST['volumenNegocio']);
        $_SESSION['departamentoActual'] = $oDepartamento;
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'editarDepartamento';
        header('Location: indexLoginLogoff.php');
        exit;
    }
}

$_SESSION['departamentoActual'] = $oDepartamento;

$avEditarDepartamento = [
    'codDepartamento' => $oDepartamento->getCodDepartamento(),
    'descDepartamento' => $oDepartamento->getDescDepartamento(),
    'fechaCreacionDepartamento' => ($oDepartamento) ? $oDepartamento->getFechaCreacionDepartamento()->format('Y-m-d') : null,
    'volumenNegocio' => $oDepartamento->getVolumenNegocio(),
    'fechaBajaDepartamento' => ($oDepartamento->getFechaBajaDepartamento()) ? $oDepartamento->getFechaBajaDepartamento()->format('Y-m-d') : null
];

require_once $view['layout'];
?>