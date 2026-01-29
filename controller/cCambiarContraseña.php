<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 29/01/2026
 */

// Comprobamos que la sesión ha sido iniciada.
if(empty($_SESSION['usuarioDWESLoginLogoff'])){
    // En caso de que no se haya iniciado sesión volvemos a la página de inicio público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que el botón "cancelar" ha sido pulsado.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'editar';
    header('Location: indexLoginLogoff.php');
    exit;
}

$entradaOk = true;
$oUsuarioActual = $_SESSION['usuarioDWESLoginLogoff'];

$aErrores = [
    'passwordActual' => null,
    'passwordNueva' => null,
    'passwordNuevaRepetir' => null
];
if(isset($_REQUEST['aplicarC'])){
    $aErrores['passwordActual'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['passwordActual'], 255, 0, 1);
    $aErrores['passwordNueva'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['passwordNueva'], 255, 0, 1);
    $aErrores['passwordNuevaRepetir'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['passwordNuevaRepetir'], 255, 0, 1);
    
    foreach($aErrores as $valor){
        if($valor != null){
            $entradaOk = false;
            echo "adios";
        }
    }
    
    if(hash('sha256', $oUsuarioActual->getCodUsuario().$_REQUEST['passwordActual']) != $oUsuarioActual->getPassword()){
        $entradaOk = false;
    }
    
    if($_REQUEST['passwordNueva'] != $_REQUEST['passwordNuevaRepetir']){
        $entradaOk = false;
    }

    if($entradaOk){
        $oUsuarioActual = UsuarioPDO::modificarContraseña($oUsuarioActual, $_REQUEST['passwordNueva']);
        $_SESSION['usuarioDWESLoginLogoff'] = $oUsuarioActual;
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
        $_SESSION['paginaEnCurso'] = 'editar';
        header('Location: indexLoginLogoff.php');
        exit;
    }
}

require_once $view['layout'];
?>