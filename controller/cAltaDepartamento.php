<?php
/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 02/02/2026
 */


// Comprobamos si el botón "cancelar" ha sido pulsado.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'mtoDepartamento';
    header('Location: indexLoginLogoff.php');
    exit;
}

$aErrores = [
    'codDepartamento' => null,
    'descDepartamento' => null,
    'volumenNegocio' => null
];

$aRespuestas = [
    'codDepartamento' => null,
    'descDepartamento' => null,
    'volumenNegocio' => null
];

$entradaOk = true;

// Comprobamos si el botón "iniciar" ha sido pulsado.
if(isset($_REQUEST['registrar'])){
    // Validar los campos del formulario.
    $aErrores['codDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['codDepartamento'], 3, 3, 1);
    $aErrores['descDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descDepartamento'], 255, 1, 1);
    $aErrores['volumenNegocio'] = validacionFormularios::comprobarFloatMonetarioES($_REQUEST['volumenNegocio'], 100000, -100000, 1);

    // Verificar si hay errores de validación.
    foreach ($aErrores as $valorCampo => $mensajeError){
        if($mensajeError != null){
            $entradaOk = false;
        }
    }
    
    // Comprobamos que el código de usuario introducido pertenece a la base de datos.
    if(!DepartamentoPDO::validaCodNoExiste($_REQUEST['codDepartamento'])){
        // En caso de existir un usuario con el mismo código invalidamos la entrada.
        $aErrores['codDepartamento'] = "El código de departamento introducido ya pertenece a un departamento existente";
        $entradaOk = false;
    }
    
    // Comprobamos que los datos son correctos.
    if($entradaOk){
        // Añadimos al array de respuestas los valores validados.
        $aRespuestas['codDepartamento'] = $_REQUEST['codDepartamento'];
        $aRespuestas['descDepartamento'] = $_REQUEST['descDepartamento'];
        $aRespuestas['volumenNegocio'] = str_replace(',', '.', $_REQUEST['volumenNegocio']);
        
        // Creamos un objeto de la clase UsuarioPDO el cual recibe el valor del método validarUsuario 
        // que busca si el usuario existe y si la contraseña es correcta.
        $oDepartamento = DepartamentoPDO::altaDepartamento($aRespuestas['codDepartamento'], $aRespuestas['descDepartamento'], $aRespuestas['volumenNegocio']);
        
        // Comprobamos si ha encontrado el usuario.
        if($oDepartamento === null){
            // En caso de no haberlo encontrado, cambiamos el flag a false.
            $entradaOk = false;
        }
    }   
} else{
    $entradaOk = false;
}

$avAltaDepartamento = [
    'aErrores' => $aErrores,
    'nombre' => (empty($_REQUEST['nombre'])) ? null : $_REQUEST['descUsuario'], 
    'usuario' => (empty($_REQUEST['usuario'])) ? null : $_REQUEST['codUsuario'],
    'respSeguridad' => (empty($_REQUEST['respSeguridad'])) ? null : $_REQUEST['respSeguridad'] 
];

// Si la validación es correcta, validar con la BD.
if($entradaOk){
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'mtoDepartamento';
    header('Location: indexLoginLogoff.php');
    exit; 
}

// Cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web.
require_once $view['layout'];
?>