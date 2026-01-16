<?php
/*
 * @author: Alvaro Allen
 * @since: 12/01/2026  
 */

// Comprobamos si el botón "cancelar" ha sido pulsado.
if(isset($_REQUEST['cancelar'])){
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: indexLoginLogoff.php');
    exit;
}

$aErrores = [
    'usuario' => null,
    'password' => null
];

$aRespuestas = [
    'usuario' => null,
    'password' => null
];

$entradaOk = true;

// Comprobamos si el botón "iniciar" ha sido pulsado.
if(isset($_REQUEST['iniciar'])){
    // Validar los campos del formulario.
    $aErrores['usuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['codUsuario'], 255, 0, 0);
    $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 20, 2, 1, 1);

    // Verificar si hay errores de validación.
    foreach ($aErrores as $valorCampo => $mensajeError){
        if($mensajeError != null){
            $entradaOk = false;
        }
    }
    
    // Comprobamos que los datos son correctos.
    if($entradaOk){
        // Añadimos al array de respuestas los valores validados.
        $aRespuestas['usuario'] = $_REQUEST['codUsuario'];
        $aRespuestas['password'] = $_REQUEST['password'];
        
        // Creamos un objeto de la clase UsuarioPDO el cual recibe el valor del método validarUsuario 
        // que busca si el usuario existe y si la contraseña es correcta.
        $oUsuario = UsuarioPDO::validarUsuario($aRespuestas['usuario'], $aRespuestas['password']);
        
        // Comprobamos si ha encontrado el usuario.
        if($oUsuario === null){
            // En caso de no haberlo encontrado, cambiamos el flag a false.
            $entradaOk = false;
        }
    }   
} else{
    $entradaOk = false;
}

// Si la validación es correcta, validar con la BD.
if($entradaOk){
    $oUsuario = UsuarioPDO::actualizarUltimaConexionUsuario($oUsuario);
    // Crea la sesión con el objeto usuario
    $_SESSION['usuarioDWESLoginLogoff'] = $oUsuario;

    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit; 
}  
// Cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web.
require_once $view['layout'];
?>