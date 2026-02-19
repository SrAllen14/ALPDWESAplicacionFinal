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

// Comprobamos si el botón "bExportar" ha sido pulsado.
if(isset($_REQUEST['bExportarDptos'])){
    // Recuperamos de la base de datos lo que ha buscado el usuario.
    $aoDptosExportar = DepartamentoPDO::buscaDepartamentosPorDescEstado($_SESSION['descDptoBuscado'], $_SESSION['estadoDptoBuscado']);
    
    $aArchivoExportar = [];
    if(!is_null($aoDptosExportar) && is_array($aoDptosExportar)){
        foreach($aoDptosExportar as $oDptoExportar){
            $aArchivoExportar[] = [
                'codDepartamento' => $oDptoExportar->getCodDepartamento(),
                'descDepartamento' => $oDptoExportar->getDescDepartamento(),
                'fechaCreacionDepartamento' => $oDptoExportar->getFechaCreacionDepartamento(),
                'volumenDeNegocio' => $oDptoExportar->getVolumenNegocio(),
                'fechaBajaDepartamento' => $oDptoExportar->getFechaBajaDepartamento()
            ];
        }
    }
    
    $jsonContenido = json_encode($aArchivoExportar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    header('Content-Disposition: attachment; filename="departamentos.json"');
    
    echo $jsonContenido;
    exit;
}

// Comprobamos que exista el valor de la sesión 'busquedaRealizada'.
if(empty($_SESSION['descDptoBuscado'])){
    // En caso de que no este exista le damos un valor por defecto.
    $sBuscada = '';
    $_SESSION['descDptoBuscado'] = $sBuscada;
}

if(empty($_SESSION['estadoDptoBuscado'])){
    $_SESSION['estadoDptoBuscado'] = 'radioTodos';
}

$aErrores = [
    'descDepartamento' => null,
    'archivoDptos' => null
];

$archivoOk = true;
$entradaOk = true;

// Comprobamos si el botón "bImportasDptos" ha sido pulsado.
if(isset($_REQUEST['bImportarDptos'])){
    $aExtensiones = ['json'];
    $nombreArchivo = $_FILES['archivoDptos']['name'] ?? '';
    $aErrores['archivoDptos'] = validacionFormularios::validarNombreArchivo($nombreArchivo, $aExtensiones, 150, 4, 0);
    
    if(!empty($aErrores['archivoDptos'])){
        $archivoOk = false;
    }
    
    // Comprobamos si el archivo ha sido seleccionado.
    if($_FILES['archivoDptos']['error'] === UPLOAD_ERR_NO_FILE){
        $aErrores['archivoDptos'] = "Por favor, seleccione un archivo antes de importar";
        $archivoOk = false;
    } else{
        // Comprobamos que la estructura del archivo enviado está bien.
        $contenidoImagen = file_get_contents($_FILES['archivoDptos']['tmp_name']);
        
        // Lo convertimos en array.
        $aDptos = json_decode($contenidoImagen, true);
        
        $aCamposObligatorios = [
            'codDepartamento',
            'fechaBajaDepartamento',
            'fechaCreacionDepartamento',
            'volumenDeNegocio',
            'descDepartamento'
            
        ];
        
        // Comprobamos que existe cada campo en el JSON.
        foreach($aDptos as $indice => $oDepartamento){
            foreach($aCamposObligatorios as $campo){
                // array_key_exists es más preciso que isset por si el valor es NULL
                if(!array_key_exists($campo, $oDepartamento)){
                    $archivoOk = false;
                    $aErrores['archivoDptos'] = "Error en la estructura del archivo JSON: <br>En el registro $indice falta el campo $campo";
                    break 2; // Rompe el bucle de campo y de dptos.
                }
            }
        }
    }
} else {
    $archivoOk = false;
}

if($archivoOk){
    // Verificamos si se ha subido un arhivo sin errores.
    if(isset($_FILES['archivoDptos']) && $_FILES['archivoDptos']['error'] === UPLOAD_ERR_OK){
        // Leemos el archivo subido.
        $contenidoImagen = file_get_contents($_FILES['archivoDptos']['tmp_name']);

        // Lo convertimos a un array.
        $aDptos = json_decode($contenidoImagen, true);

        // Lo guardamos en la base de datos
        DepartamentoPDO::insertarDepartamentos($aDptos);

    } else{
        $aErrores['archivoDptos'] = "Error al subir el archivo";
    }
}

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
    $_SESSION['estadoDptoBuscado'] = (isset($_REQUEST['radio'])) ? $_REQUEST['radio'] : 'radioTodos';
    $_SESSION['paginaActualTablaDepartamentos'] = 1;
} else{
    $entradaOk = false;
}

$aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDescEstado($_SESSION['descDptoBuscado'], $_SESSION['estadoDptoBuscado']);

$totalPaginas = ceil(DepartamentoPDO::contarDepartamentoPorDescEstado($_SESSION['descDptoBuscado'], $_SESSION['estadoDptoBuscado'])/ RESULTADOSPORPAGINA) ;

$paginaActual = $_SESSION['paginaActualTablaDepartamentos'] ?? 1;
if(isset($_REQUEST['paginaInicial'])){$paginaActual = 1;}
if(isset($_REQUEST['paginaAnterior'])){$paginaActual > 1 ? $paginaActual-- : '';}
if(isset($_REQUEST['paginaSiguiente'])){$paginaActual < $totalPaginas ? $paginaActual++ : '';}
if(isset($_REQUEST['paginaFinal'])){$paginaActual = $totalPaginas;}

$_SESSION['paginaActualTablaDepartamentos'] = $paginaActual;

$aDepartamentos = DepartamentoPDO::buscaDepartamentoPorDescEstadoPaginado($_SESSION['descDptoBuscado'], $_SESSION['estadoDptoBuscado'], $paginaActual);

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
    $oDepartamento = DepartamentoPDO::bajaLogicaDepartamento($_REQUEST['bBajaLogica']);
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
    $oDepartamento = DepartamentoPDO::rehabilitaDepartamento($_REQUEST['bAltaLogica']);
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

$avMtoDepartamentos = [
    'radioActual' => ($_SESSION['estadoDptoBuscado']) ? $_SESSION['estadoDptoBuscado'] : 'radioTodos',
    'paginaActual' => $paginaActual,
    'paginaFinal' => $totalPaginas
];

require_once $view['layout'];