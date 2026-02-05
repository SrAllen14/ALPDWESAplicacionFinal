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

// Comprobamos si el botón "bAlta" ha sido pulsado.
if(isset($_REQUEST['bAlta'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'altaDepartamento';
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

// Comprobamos que el botón "buscar" ha sido pulsado.
if(isset($_REQUEST['buscar'])){
    // En caso de ser pulsado realizamos la busqueda de departamento por descripción.
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

// Comprobamos que el botón "bVer" ha sido pulsado.
if(isset($_REQUEST['bVer'])){
    // En caso de haber sido pulsado buscamos el departamento por código, 
    // lo guardamos en la sesión y nos dirigimos a la página de consultar.
    $oDepartamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['bVer']);
    $_SESSION['departamentoActual'] = $oDepartamentoActual;
    $_SESSION['accionDepartamento'] = "ver";
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'consultarModificarDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que el botón "bEditar" ha sido pulsado.
if(isset($_REQUEST['bEditar'])){
    // En caso de haber sido pulsado buscamos el departamento por código,
    // lo guardamos en la sesión y nos dirigimos a la página de editar.
    $oDepartamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['bEditar']);
    $_SESSION['accionDepartamento'] = "editar";
    $_SESSION['departamentoActual'] = $oDepartamentoActual;
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'consultarModificarDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que el botón "bBorrar" ha sido pulsado.
if(isset($_REQUEST['bBorrar'])){
    // En caso de haber sido pulsado buscamos el departamento por código,
    // lo guardamos en la sesión y nos dirigimos a la página de editar.
    $oDepartamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['bBorrar']);
    $_SESSION['departamentoActual'] = $oDepartamentoActual;
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'eliminarDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que el botón "bBajaLogica" ha sido pulsado.
if(isset($_REQUEST['bBajaLogica'])){
    // En caso de haber sido pulsado guardamos el departamento por código en
    // la sesión y realizamos la baja lógica del departamento. Recargamos la página.
    $oDepartamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['bBajaLogica']);
    $_SESSION['departamentoActual'] = $oDepartamentoActual;
    $oDepartamento = DepartamentoPDO::bajaLogicaDepartamento($_SESSION['departamentoActual']);
    $_SESSION['departamentoActual'] = $oDepartamento;
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'mtoDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que el botón "bAltaLogica" ha sido pulsado.
if(isset($_REQUEST['bAltaLogica'])){
    // En caso de haber sido pulsado guardamos el departamento por código en
    // la sesión y realizamos la rehabilitación del departamento. Recargamos la página.
    $oDepartamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['bAltaLogica']);
    $_SESSION['departamentoActual'] = $oDepartamentoActual;
    $oDepartamento = DepartamentoPDO::rehabilitaDepartamento($_SESSION['departamentoActual']);
    $_SESSION['departamentoActual'] = $oDepartamento;
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'mtoDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

$avDepartamentos = [];
if (!is_null($aDepartamentos) && is_array($aDepartamentos)) {
    foreach ($aDepartamentos as $oDepartamento) {

        // Creamos las fechas que vienen del objeto Departamento para formatearlas antes de pasarlas a la vista
        $fechaCreacion = new DateTime($oDepartamento->getFechaCreacionDepartamento());
        $fechaBajaFormateada = '';
        if (!is_null($oDepartamento->getFechaBajaDepartamento())) {
            $fechaBaja = new DateTime($oDepartamento->getFechaBajaDepartamento());
            $fechaBajaFormateada = $fechaBaja->format('d/m/Y');
        }

        $avDepartamentos[] = [
            'codDepartamento'           => $oDepartamento->getCodDepartamento(),
            'descDepartamento'          => $oDepartamento->getDescDepartamento(),
            'fechaCreacionDepartamento' => $fechaCreacion->format('d/m/Y'),
            'volumenDeNegocio'          => (number_format($oDepartamento->getVolumenNegocio(), 2, ',', '.') . ' €'),
            'fechaBajaDepartamento'     => $fechaBajaFormateada,
            'estadoDepartamento'        => $fechaBajaFormateada==''?'baja':'alta'
        ];
    }
}
require_once $view['layout'];