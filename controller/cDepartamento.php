<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 23/01/2026
 */

// Comprobamos si el botón "iniciar" ha sido pulsado.
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
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
} else{
    $entradaOk = false;
}

if($entradaOk){
    $sBuscada = $_REQUEST['codDepartamento'];
} else{
    $sBuscada = "";
}
$aDepartamentos = DepartamentoPDO::buscaDepartamentoPorDesc($sBuscada);

$avDepartamentos = [
    'aDepartamentos' => $aDepartamentos
];

require_once $view['layout'];