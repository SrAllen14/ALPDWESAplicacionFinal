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

            $oDepartamento = new Departamento(
                    $departamentoDB['T02_CodDepartamento'],
                    $departamentoDB['T02_DescDepartamento'],
                    $departamentoDB['T02_FechaCreacionDepartamento'],
                    $departamentoDB['T02_VolumenDeNegocio']);
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

    public static function bajaFisicaDepartamento() {
        
    }

    public static function bajaLogicaDepartamento() {
        
    }

    public static function modificaDepartamento() {
        
    }

    public static function rehabilitaDepartamento() {
        
    }

    public static function validaCodNoExiste() {
        
    }
}
