<?php
/**
 * Clase DBPDO
 * 
 * Interactua directamente con la base de datos haciendo como un puente entre la base y el controlador.
 * 
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 19/01/2026
 */
class DBPDO{
    /**
     * Método ejecutaConsulta
     * 
     * Ejecuta la consulta pasada como parámetro después de realizar una conexión a la base de datos.
     * 
     * @param (string) $sentenciaSQL Posible sentencia de sql como INSERT, UPDATE, SELECT o DELETE.
     * @param (Array) $aParametros Array de parámetros para realizar la consulta. 
     * @return (PDO) Objeto PDO con el resultado de la consulta.
     */
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