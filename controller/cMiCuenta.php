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

// Comprobamos que el botón "volver" ha sido pulsado.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}


// Comprobamos que el botón "cambiarC" ha sido pulsado.
if(isset($_REQUEST['cambiarC'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'cambiarPassword';
    header('Location: indexLoginLogoff.php');
    exit;
}

// Comprobamos que el botón "borrarCuenta" ha sido pulsado.
if(isset($_REQUEST['borrarC'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'borrarCuenta';
    header('Location: indexLoginLogoff.php');
    exit;
}

$oUsuarioActual = $_SESSION['usuarioDWESLoginLogoff'];
$fechaHoraUltimaConexionAnterior = $oUsuarioActual->getFechaHoraUltimaConexionAnterior();
$entradaOk = true;

$aErrores = [
  'nombre' => null  
];

if(isset($_REQUEST['aplicarC'])){
    $aErrores['nombre'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descUsuario'], 255, 0, 1);
    
    foreach($aErrores as $valor){
        if($valor != null){
            $entradaOk = false;
        }
    }
    
    if($entradaOk){
        echo "hola";
        $oUsuarioActual = UsuarioPDO::modificarUsuario($oUsuarioActual->getCodUsuario(), $_REQUEST['descUsuario']);
        $_SESSION['usuarioDWESLoginLogoff'] = $oUsuarioActual;
        $_SESSION['usuarioDWESLoginLogoff']->setFechaHoraUltimaConexionAnterior($fechaHoraUltimaConexionAnterior);
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'inicioPrivado';
        header('Location: indexLoginLogoff.php');
        exit;
    }
}


$avEditar = [
    'nombre' => $_SESSION['usuarioDWESLoginLogoff']->getDescUsuario(),
    'codUsuario' => $_SESSION['usuarioDWESLoginLogoff']->getCodUsuario(),
    'password' => $_SESSION['usuarioDWESLoginLogoff']->getPassword(),
    'perfil' => $_SESSION['usuarioDWESLoginLogoff']->getPerfil(),
    'numeroAccesos' => $_SESSION['usuarioDWESLoginLogoff']->getContadorAccesos(),
    'fechaUltimaConexion' => $_SESSION['usuarioDWESLoginLogoff']->getFechaHoraUltimaConexion()->format('Y-m-d H:i:s'),
    'fechaUltimaConexionAnterior' => ($_SESSION['usuarioDWESLoginLogoff']->getFechaHoraUltimaConexionAnterior()) ? $_SESSION['usuarioDWESLoginLogoff']->getFechaHoraUltimaConexionAnterior()->format('Y-m-d H:i:s') : null 
];
// Cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web.
require_once $view['layout'];
?>