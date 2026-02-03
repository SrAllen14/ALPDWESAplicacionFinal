<?php

/**
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 23/01/2026
 * @source DepartamentoPDO.php
 */

require_once 'model/Departamento.php';
require_once 'model/DBPDO.php';

class DepartamentoPDO {
    /**
     * Método buscaDepartamentoPorCod
     * 
     * Buscar un departamento por su código en la base de datos.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     * @param (string) $codDepartamento Código del departamento
     * @return (Departamento) Objeto de la clase departamento.
     */
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

    /**
     * Método buscaDepartmentoPorDesc
     * 
     * Busca los departamentos que contengan en la descripción la cadena introducida.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     * @param (string) $descDepartamento Descripción de departamento a buscar.
     * @return (Array) Array de objetos de la clase Departamento que coinciden con la descripción.
     */
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

    /**
     * Método altaDepartamento
     * 
     * Inserta un departamento nuevo en la base de datos.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     * @param (string) $codDepartamento Código del departamento.
     * @param (string) $descDepartamento Descripción del departamento.
     * @param (float) $volumenNegocio Cantidad de dinero que tiene el departamento.
     * @return (Departamento) Objeto de la clase Departamento.
     */
    public static function altaDepartamento($codDepartamento, $descDepartamento, $volumenNegocio) {
        // Creamos un objeto usuario pero inicializado a null.
        $oDepartamento = null;

        // Ceramos y definimos una variable con la consulta de insercción para crear un usuario.
        $sql = <<<SQL
            INSERT INTO T02_Departamento
                (T02_CodDepartamento, T02_FechaCreacionDepartamento, T02_FechaBajaDepartamento,
                T02_DescDepartamento, T02_VolumenDeNegocio)
            VALUES
                (:codDepartamento, now(), null, :descDepartamento, :volumenNegocio)
        SQL;

        try {
            $consulta = DBPDO::ejecutaConsulta($sql,
                            [':codDepartamento' => $codDepartamento,
                             ':descDepartamento' => $descDepartamento,
                             ':volumenNegocio' => $volumenNegocio]);
            if ($consulta) {
                $oDepartamento = self::buscaDepartamentoPorCod($codDepartamento);
            }
        } catch (Exception $ex) {
            return null;
        }

        return $oDepartamento;
    }

    /**
     * Método bajaFisicaDepartamento
     * 
     * Borra el departamento de la base de datos.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     * @param (Departamento) $oDepartamento Objeto de la clase Departamento.
     * @return (boolean) true: ha sido borrado correctamente. false: ha habido un error en la ejecución.
     */
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

    /**
     * Método bajaLogicaDepartamento
     * 
     * Inhabilita el departamento para que no pueda ser utilizado (dar de baja temporal o lógica).
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     * @param (Departamento) $oDepartamento Objeto de la clase Departamento.
     * @return (Departamento) Objeto de la clase Departamento.
     */
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
    
    /**
     * Método modificaDepartamento
     * 
     * Editar los datos de un objeto en la base de datos.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     * @param (string) $oDepartamento Objeto de la clase Departamento
     * @param (string) $descDepartamentoNuevo Descripción nueva del departamento.
     * @param (float) $volumenNegocioNuevo Volumen nuevo del departamento.
     * @return (Departamento) Objeto de la clase Departamento.
     */
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

    /**
     * Método rehabilitarDepartamento
     * 
     * Habilita un departamento que está dado de baja lógica.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     * @param (Departamento) $oDepartamento Objeto de la clase Departamento.
     * @return (Departamento) Objeto de la clase Departamento.
     */
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

    /**
     * Método validarCodNoExiste
     * 
     * Comprobar que el código introducido no pertenece a un objeto de la clase Departamento existente.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     * @param (string) $codDepartamento Código del departamento
     * @return (boolean) true: en caso de que no pertenezca a nadie. false: en caso de que ya pertenezca a un departamento.
     */
    public static function validaCodNoExiste($codDepartamento) {
        $sql = <<<SQL
            SELECT T02_CodDepartamento FROM T02_Departamento
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
                return true;
            } else{
                return false;
            }
        } catch (Exception $ex) {
            // En caso de error, devolvemos null.
            echo $ex->getMessage();
        }
    }
}
