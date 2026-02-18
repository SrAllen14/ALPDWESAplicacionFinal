<?php

/**
 * Clase DepartamentoPDO
 * 
 * Conecta la base de datos con el controlador de la aplicación.
 * 
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 23/01/2026
 * @source DepartamentoPDO.php
 */

require_once __DIR__.'/Departamento.php';
require_once __DIR__.'/DBPDO.php';

class DepartamentoPDO {
    /*
     * Método obtenerTodosCodigosDepartamentos
     * 
     * Obtener los códigos de cada departamento existente en la base de datos.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 18/02/2026
     * @return (Array) Vector de códigos de departamentos
     */
    public static function obtenerTodosCodigosDepartamentos(){
        $sql = <<<SQL
            SELECT
                T02_CodDepartamento
            FROM T02_Departamento
        SQL;
        try {
            // Ejecutar la consulta. 
            $consulta = DBPDO::ejecutaConsulta($sql);
            $aCodDepartamentos = null;
            
            while ($codDepartamento = $consulta->fetch()) {
                $aCodDepartamentos[] = $codDepartamento[0];
            }
            
            return $aCodDepartamentos;
        } catch (Exception $ex) {
            // En caso de error, devolvemos null.
            echo $ex->getMessage();
            return null;
        }
    }
    
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
     * Método buscaDepartamentosPorDescEstado
     * 
     * Buscar departamentos por descripción y estado.
     * 
     * @param type $descDpto
     * @param type $estadoDpto
     * @return type
     */
    public static function buscaDepartamentosPorDescEstado($descDpto, $estadoDpto){
        $aoDepartamentos = [];
        if($estadoDpto == 'radioTodos'){
            $aoDepartamentos = self::buscaDepartamentoPorDesc($descDpto);
        } else{
            $estado = ($estadoDpto === 'radioAlta') ? "IS NULL" : "IS NOT NULL";
            
            $sql = <<<SQL
                SELECT * FROM T02_Departamento
                WHERE T02_DescDepartamento LIKE :descDepartamento
                AND T02_FechaBajaDepartamento $estado
            SQL;
            
            $parametros = [
                ':descDepartamento' => '%'.$descDpto.'%'
            ];
            
            $consulta = DBPDO::ejecutaConsulta($sql, $parametros);
            
            while ($oDepartamento = $consulta->fetchObject()){
                $aoDepartamentos[] = new Departamento(
                    $oDepartamento->T02_CodDepartamento,
                    $oDepartamento->T02_DescDepartamento,
                    $oDepartamento->T02_FechaCreacionDepartamento,
                    $oDepartamento->T02_VolumenDeNegocio,
                    $oDepartamento->T02_FechaBajaDepartamento
                );
            }
        }
        return $aoDepartamentos;
    }
    
    /**
     * Método ContarDepartamentoPorDescEstado
     * 
     * 
     * 
     * @param type $descDpto
     * @param type $estadoDpto     
     */
    public static function contarDepartamentoPorDescEstado($descDpto, $estadoDpto){
        if($estadoDpto == 'radioTodos'){
            $sql = <<<SQL
                SELECT COUNT(*) numeroDepartamentos FROM T02_Departamento
                WHERE T02_DescDepartamento LIKE :descDepartamento
            SQL;
        } else{
            $estado = ($estadoDpto === 'radioAlta') ? "IS NULL" : "IS NOT NULL";
            
            $sql = <<<SQL
                SELECT COUNT(*) numeroDepartamentos FROM T02_Departamento
                WHERE T02_DescDepartamento LIKE :descDepartamento
                AND T02_FechaBajaDepartamento $estado
            SQL;
        }
        
        $parametros = [
            ':descDepartamento' => '%'.$descDpto.'%'
        ];

        $consulta = DBPDO::ejecutaConsulta($sql, $parametros);

        if($contar = $consulta->fetchObject()){
            return $contar->numeroDepartamentos;
        }
        return 0;
    }
    
    public static function buscaDepartamentoPorDescEstadoPaginado($descDpto, $estadoDpto, $paginaActual){
        $numResultados = (int) RESULTADOSPORPAGINA; 
        $indicePagina = (int) (($paginaActual - 1) * $numResultados);
        
        if($estadoDpto == 'radioTodos'){
            $sql = <<<SQL
                SELECT * FROM T02_Departamento
                WHERE lower(T02_DescDepartamento) LIKE lower(:descDepartamento)
                LIMIT $numResultados OFFSET $indicePagina
            SQL;
        } else{
            $estado = ($estadoDpto == 'radioAlta') ? "IS NULL" : "IS NOT NULL";

            $sql = <<<SQL
                SELECT * FROM T02_Departamento
                WHERE lower(T02_DescDepartamento) LIKE lower(:descDepartamento)
                AND T02_FechaBajaDepartamento $estado
                LIMIT $numResultados OFFSET $indicePagina
            SQL;  
        }
        
        $parametros = [
            ':descDepartamento' => '%'.$descDpto.'%'
        ];
        
        $consulta = DBPDO::ejecutaConsulta($sql, $parametros);
        
        $aoDepartamentos = [];
        while($oDpto = $consulta->fetchObject()){
            $aoDepartamentos[] = new Departamento(
                $oDpto->T02_CodDepartamento,
                $oDpto->T02_DescDepartamento,
                $oDpto->T02_FechaCreacionDepartamento,
                $oDpto->T02_VolumenDeNegocio,
                $oDpto->T02_FechaBajaDepartamento
            );
        }
        return $aoDepartamentos;
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
     * Método insertarDepartamentos
     * 
     * Inserta una cantidad de departamentos importada desde un archivo JSON.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 29/01/2026
     */
    public static function insertarDepartamentos($aDepartamentos){
        $sql = <<<SQL
            INSERT INTO T02_Departamento(
                T02_CodDepartamento, 
                T02_FechaCreacionDepartamento, 
                T02_FechaBajaDepartamento,
                T02_DescDepartamento, 
                T02_VolumenDeNegocio
                )VALUES(
                :codDepartamento, 
                :fechaCreacionDepartamento,
                :fechaBajaDepartamento,
                :descDepartamento,
                :volumenDeNegocio
            )
        SQL;
        
        $aParametros = [];
        
        // Construyo el array de parametros pasando los datos a objetos que pide la BBDD.
        foreach($aDepartamentos as $departamento){
            // Pasamos el campo fecha a un objeto DateTime para poder insertar correctamente en la BBDD.
            $oFechaCreacion = new DateTime($departamento['fechaCreacionDepartamento']);
            $oFechaCreacion = $oFechaCreacion->format('Y-m-d');
            
            // Comprobamos si el departamento está dado de baja
            if($departamento['fechaBajaDepartamento'] === null){
                // En caso de que no exista una fecha de baja devolvemos null.
                $oFechaBaja = null;
            } else{
                // En caso de que si esté dado de baja.
                $oFechaBaja = new DateTime($departamento['fechaBajaDepartamento']);
                $oFechaBaja = $oFechaBaja->format('Y-m-d');
            }
            
            $aParametros[] = [
                ':codDepartamento' => $departamento['codDepartamento'],
                ':descDepartamento' => $departamento['descDepartamento'],
                ':fechaCreacionDepartamento' => $departamento['fechaCreacionDepartamento'],
                ':volumenDeNegocio' => $departamento['volumenDeNegocio'],
                ':fechaBajaDepartamento' => $oFechaBaja
            ];
        }
        
        try{
            DBPDO::ejecutarConsultaTransaccion($sql, $aParametros);
            return true;
        } catch(PDOException $exPDO){
            return false;
        }
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
    public static function bajaFisicaDepartamento($codDepartmento) {
        $sql = <<<SQL
            DELETE FROM T02_Departamento
            WHERE T02_CodDepartamento = :codDepartamento
        SQL;
        
        try{
            $consulta = DBPDO::ejecutaConsulta($sql, [
                ':codDepartamento' => $codDepartmento
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
    public static function bajaLogicaDepartamento($codDepartmento) {
        $sql = <<<SQL
            UPDATE T02_Departamento
                SET T02_FechaBajaDepartamento = now()
                WHERE T02_CodDepartamento = :codDepartamento
        SQL;
        
        try{
            $consulta = DBPDO::ejecutaConsulta($sql, [
                ':codDepartamento' => $codDepartmento
            ]);
            
            if($consulta){
                return self::buscaDepartamentoPorCod($codDepartamento);
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
    public static function modificaDepartamento($codDepartamento, $descDepartamentoNuevo, $volumenNegocioNuevo) {
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
                ':codDepartamento' => $codDepartamento
            ]);
            
            if($consulta){
                
                return self::buscaDepartamentoPorCod($codDepartamento);
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
    public static function rehabilitaDepartamento($codDepartamento) {
        $sql = <<<SQL
            UPDATE T02_Departamento
                SET T02_FechaBajaDepartamento = null
                WHERE T02_CodDepartamento = :codDepartamento
        SQL;
        
        try{
            $consulta = DBPDO::ejecutaConsulta($sql, [
                ':codDepartamento' => $codDepartamento
            ]);
            
            if($consulta){
                return self::buscaDepartamentoPorCod($codDepartamento);
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
