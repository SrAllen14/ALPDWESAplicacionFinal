<?php

/**
 * Web Service VolumenDeDepartamentoPorCodigo
 * 
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 17/02/2026
 */
require_once '../model/Departamento.php';
require_once '../model/DepartamentoPDO.php';
require_once '../model/DBPDO.php';
require_once '../config/confDBPDO.php';

header('Content-Type: application/json; charset-utf-8');
$entradaOk = true;

if($entradaOk){
    $oDepartamentoDevuelto = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['codDepartamento'] ?? 'DWA');
    $aDepartamentoDevuelto = null;
    if($oDepartamentoDevuelto){
        $aDepartamentoDevuelto = [
            'codDepartamento' => $oDepartamentoDevuelto->getCodDepartamento(),
            'descDepartamento' => $oDepartamentoDevuelto->getDescDepartamento(),
            'fechaCreacionDepartamento' => $oDepartamentoDevuelto->getFechaCreacionDepartamento(),
            'fechaBajaDepartamento' => $oDepartamentoDevuelto->getFechaBajaDepartamento(),
            'volumenNegocio' => $oDepartamentoDevuelto->getVolumenNegocio()
        ];
    } else{
        echo null;
    }
    echo json_encode($aDepartamentoDevuelto, JSON_PRETTY_PRINT);
}

?>