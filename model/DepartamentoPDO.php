<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 23/01/2026
 */

require_once 'model/Departamento.php';
require_once 'model/DBPDO.php';

class DepartamentoPDO {

    public static function buscaDepartamentoPorCod($codDepartamento) {
        $sql = <<<SQL
            SELECT
                T02_CodDepartamento,
                T02_FechaCreacionDepartamento,
                T02_FechaBajaDepartamento,
                T02_DescDepartamento,
                T02_VolumenDeNegocio
            FROM T02_Departamento
            WHERE T02_CodDepartamento = :codDepartamento
        SQL;
        try {
            // Ejecutar la consulta. 
            $consulta = DBPDO::ejecutaConsulta($sql, [
                        ':codDepartamento' => $codDepartamento]);

            // Obtener el resultado de la consulta.
            $departamentoDB = $consulta->fetch(PDO::FETCH_ASSOC);

            // Si no existe el usuario o la contraseña es incorrecta, devolvemos null.
            if (!$departamentoDB) {
                return null;
            }

            $fechaDB = $departamentoDB['T02_FechaCreacionDepartamento'];
            $oFechaValida = ($fechaDB) ? new DateTime($fechaDB) : null;
            
            $fechaBajaDB = $departamentoDB['T02_FechaBajaDepartamento'];
            $oFechaBajaValida = ($fechaBajaDB) ? new DateTime($fechaBajaDB) : null;
            
            $oDepartamento = new Departamento(
                    $departamentoDB['T02_CodDepartamento'],
                    $departamentoDB['T02_DescDepartamento'],
                    $oFechaValida,
                    $departamentoDB['T02_VolumenDeNegocio'],
                    $oFechaBajaValida);
            return $oDepartamento;
        } catch (Exception $ex) {
            // En caso de error, devolvemos null.
            echo $ex->getMessage();
            return null;
        }
    }

    public static function buscaDepartamentoPorDesc($descDepartamento = null) {
        $aDepartamentos = [];
        $sql = <<<SQL
            SELECT * FROM T02_Departamento 
            WHERE T02_DescDepartamento LIKE :descDpto
        SQL;
        try {
            // Ejecutar la consulta. 
            $consulta = DBPDO::ejecutaConsulta($sql, [':descDpto' => "%$descDepartamento%"]);

            while ($oDepartamento = $consulta->fetchObject()) {
                $aDepartamentos[] = new Departamento(
                    $oDepartamento->T02_CodDepartamento,
                    $oDepartamento->T02_DescDepartamento,
                    $oDepartamento->T02_FechaCreacionDepartamento,
                    $oDepartamento->T02_VolumenDeNegocio,
                    $oDepartamento->T02_FechaBajaDepartamento
                );
            }
            return $aDepartamentos;
        } catch (Exception $ex) {
            // En caso de error, devolvemos null.
            echo $ex->getMessage();
            return null;
        }
    }

    public static function altaDepartamento() {
        
    }

    public static function bajaFisicaDepartamento($oDepartamento) {
        $sql = <<<SQL
            DELETE FROM T02_Departamento
            WHERE T02_CodDepartamento = :codDepartamento
        SQL;
        
        try{
            $consulta = DBPDO::ejecutaConsulta($sql, [
                ':codDepartamento' => $oDepartamento->getCodDepartamento()
            ]);
            
            if($consulta->rowCount() > 0){
                return true;
            }
        } catch(Exception $ex){
            return false;
        }
        return false;
    }

    public static function bajaLogicaDepartamento($oDepartamento) {
        $sql = <<<SQL
            UPDATE T02_Departamento
                SET T02_FechaBajaDepartamento = now()
                WHERE T02_CodDepartamento = :codDepartamento
        SQL;
        
        try{
            $consulta = DBPDO::ejecutaConsulta($sql, [
                ':codDepartamento' => $oDepartamento->getCodDepartamento()
            ]);
            
            if($consulta){
                $oDepartamento->setFechaBajaDepartamento(new DateTime());
                return $oDepartamento;
            } else{
                return null;
            }
        } catch(Exception $ex){
            return null;
        }
    }

    public static function modificaDepartamento($oDepartamento, $descDepartamentoNuevo, $volumenNegocioNuevo) {
        $sql = <<<SQL
            UPDATE T02_Departamento
                SET T02_DescDepartamento = :descDepartamento,
                T02_VolumenDeNegocio = :volumenNegocio
                WHERE T02_CodDepartamento = :codDepartamento
        SQL;
        
        try{
            $consulta = DBPDO::ejecutaConsulta($sql, [
                ':descDepartamento' => $descDepartamentoNuevo,
                ':volumenNegocio' => $volumenNegocioNuevo,
                ':codDepartamento' => $oDepartamento->getCodDepartamento()
            ]);
            
            if($consulta){
                $oDepartamento->setDescDepartamento($descDepartamentoNuevo);
                $oDepartamento->setVolumenNegocio($volumenNegocioNuevo);
                return $oDepartamento;
            } else{
                return null;
            }
        } catch(Exception $ex){
            return null;
        }
    }

    public static function rehabilitaDepartamento($oDepartamento) {
        $sql = <<<SQL
            UPDATE T02_Departamento
                SET T02_FechaBajaDepartamento = null
                WHERE T02_CodDepartamento = :codDepartamento
        SQL;
        
        try{
            $consulta = DBPDO::ejecutaConsulta($sql, [
                ':codDepartamento' => $oDepartamento->getCodDepartamento()
            ]);
            
            if($consulta){
                $oDepartamento->setFechaBajaDepartamento(null);
                return $oDepartamento;
            } else{
                return null;
            }
        } catch(Exception $ex){
            return null;
        }
    }

    public static function validaCodNoExiste() {
        
    }
}
