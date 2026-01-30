<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 23/01/2026
 */

// Comprobamos que la sesión ha sido iniciada.
if(empty($_SESSION['usuarioDWESLoginLogoff'])){
    // En caso de que no haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos si el botón "iniciar" ha sido pulsado.
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que exista el valor de la sesión 'busquedaRealizada'.
if(empty($_SESSION['descDptoBuscado'])){
    // En caso de que no este exista le damos un valor por defecto.
    $sBuscada = '';
    $_SESSION['descDptoBuscado'] = $sBuscada;
}

$aErrores = [
    'descDepartamento' => null
];

$entradaOk = true;

if(isset($_REQUEST['buscar'])){
    $aErrores['descDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['codDepartamento'], 255, 0, 0);
    
    if($aErrores['descDepartamento'] != null){
        $entradaOk = false;
    }
    
    if($entradaOk){
        $sBuscada = $_REQUEST['codDepartamento'];
    } else{
        $sBuscada = "";
    }
    
    $_SESSION['descDptoBuscado'] = $sBuscada;
} else{
    $entradaOk = false;
}


$aDepartamentos = DepartamentoPDO::buscaDepartamentoPorDesc($_SESSION['descDptoBuscado']);


if(isset($_REQUEST['bVer'])){
    $oDepartamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['bVer']);
    $_SESSION['departamentoActual'] = $oDepartamentoActual;
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'verDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

if(isset($_REQUEST['bEditar'])){
    $oDepartamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['bEditar']);
    $_SESSION['departamentoActual'] = $oDepartamentoActual;
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'editarDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

if(isset($_REQUEST['bBorrar'])){
    $oDepartamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['bBorrar']);
    if(DepartamentoPDO::bajaFisicaDepartamento($oDepartamentoActual)){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'departamento';
        header('Location: indexLoginLogoff.php');
        exit;
    }
}



$avDepartamentos = [
    'aDepartamentos' => $aDepartamentos
];

require_once $view['layout'];