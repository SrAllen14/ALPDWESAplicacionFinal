<?php
/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 22/01/2026
 */


// Comprobamos si el botón "cancelar" ha sido pulsado.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'login';
    header('Location: indexLoginLogoff.php');
    exit;
}

$aErrores = [
    'nombre' => null,
    'usuario' => null,
    'password' => null,
    'passwordRep' => null
];

$aRespuestas = [
    'nombre' => null,
    'usuario' => null,
    'password' => null,
    'passwordRep' => null
];

$entradaOk = true;

// Comprobamos si el botón "iniciar" ha sido pulsado.
if(isset($_REQUEST['registrar'])){
    // Validar los campos del formulario.
    $aErrores['nombre'] = validacionFormularios::comprobarAlfabetico($_REQUEST['descUsuario'], 255, 0, 1);
    $aErrores['usuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['codUsuario'], 255, 0, 1);
    $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 20, 2, 1, 1);
    $aErrores['passwordRep'] = validacionFormularios::validarPassword($_REQUEST['passwordRep'], 20, 2, 1, 1);

    // Verificar si hay errores de validación.
    foreach ($aErrores as $valorCampo => $mensajeError){
        if($mensajeError != null){
            $entradaOk = false;
        }
    }
    
    // Comprobamos que los campos de "password" y "passwordRep" son diferentes.
    if($_REQUEST['password'] !== $_REQUEST['passwordRep']){
        // En caso de ser diferentes invalidamos la entrada.
        $entradaOk = false;
    }
    
    // Comprobamos que los datos son correctos.
    if($entradaOk){
        // Añadimos al array de respuestas los valores validados.
        $aRespuestas['nombre'] = $_REQUEST['descUsuario'];
        $aRespuestas['usuario'] = $_REQUEST['codUsuario'];
        $aRespuestas['password'] = $_REQUEST['password'];
        
        // Creamos un objeto de la clase UsuarioPDO el cual recibe el valor del método validarUsuario 
        // que busca si el usuario existe y si la contraseña es correcta.
        $oUsuario = UsuarioPDO::altaUsuario($aRespuestas['usuario'], $aRespuestas['password'], $aRespuestas['nombre']);
        
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