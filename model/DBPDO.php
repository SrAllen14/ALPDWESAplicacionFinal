<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


class DBPDO{
    public static function ejecutaConsulta($sentenciaSQL, $aParametros = null){
        try{
            $conexion = new PDO(DSN, USERNAME, PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta = $conexion->prepare($sentenciaSQL);
            $consulta->execute($aParametros);
            
            return $consulta;
        } catch(PDOException $exPDO){
            $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
            $_SESSION['paginaEnCurso'] = 'error';
            $_SESSION['error'] = new AppError($exPDO->getCode(), $exPDO->getMessage(), $exPDO->getFile(), $exPDO->getLine(), $_SESSION['paginaAnterior']);
            header('Location: indexLoginLogoff.php');
            exit;
        }
    }
}