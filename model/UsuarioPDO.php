<?php

/**
 * Clase UsuarioPDO
 * 
 * Conecta la base de datos con el controlador de la aplicación.
 * 
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 22/01/2026
 * @source iValidacionFormularios.php
 */

require_once 'DBPDO.php';
require_once 'Usuario.php';

class UsuarioPDO {
    public static function buscarUsuarioPorCod($codUsuario){
        $sql = <<<SQL
            SELECT * FROM T01_Usuario
            WHERE T01_CodUsuario = :usuario
        SQL;
        try {
            // Ejecutar la consulta. 
            $consulta = DBPDO::ejecutaConsulta($sql, [
                        ':usuario' => $codUsuario]);

            // Obtener el resultado de la consulta.
            $usuarioDB = $consulta->fetch(PDO::FETCH_ASSOC);

            // Si no existe el usuario o la contraseña es incorrecta, devolvemos null.
            if (!$usuarioDB) {
                return null;
            }

            $fechaDB = $usuarioDB['T01_FechaHoraUltimaConexion'];
            $oFechaValida = ($fechaDB) ? new DateTime($fechaDB) : null;

            $oUsuario = new Usuario(
                $usuarioDB['T01_CodUsuario'],
                $usuarioDB['T01_Password'],
                $usuarioDB['T01_DescUsuario'],
                $usuarioDB['T01_NumConexiones'],
                $oFechaValida,
                null,
                $usuarioDB['T01_Perfil'],
                $usuarioDB['T01_ImagenUsuario']);
            return $oUsuario;
        } catch (Exception $ex) {
            // En caso de error, devolvemos null.
            echo $ex->getMessage();
            return null;
        }
    }
    
    /**
     * Método validarUsuario
     * 
     * Recibe un código de usuario y una contraseña
     * con el fin de confirmar que existe el usuario 
     * con ese código y que coinciden la contraseña 
     * introducida con la del usuario encontrado.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 22/01/2026
     * @param (string) código indentificativo de cada usuario.
     * @param (string) contraseña del usuario para confirmar su identificación.
     * @return (Usuario) objeto de la clase usuario construido con la base de datos.
     */
    public static function validarUsuario($codUsuario, $password) {
        $sql = <<<SQL
            SELECT
                T01_CodUsuario,
                T01_Password,
                T01_DescUsuario,
                T01_FechaHoraUltimaConexion,
                T01_NumConexiones,
                T01_Perfil,
                T01_ImagenUsuario
            FROM T01_Usuario
            WHERE T01_CodUsuario = :usuario
              AND T01_Password = SHA2(:password, 256)
        SQL;
        try {
            // Ejecutar la consulta. 
            $consulta = DBPDO::ejecutaConsulta($sql, [
                        ':usuario' => $codUsuario,
                        ':password' => $codUsuario . $password]);

            // Obtener el resultado de la consulta.
            $usuarioDB = $consulta->fetch(PDO::FETCH_ASSOC);

            // Si no existe el usuario o la contraseña es incorrecta, devolvemos null.
            if (!$usuarioDB) {
                return null;
            }

            $fechaDB = $usuarioDB['T01_FechaHoraUltimaConexion'];
            $oFechaValida = ($fechaDB) ? new DateTime($fechaDB) : null;

            $oUsuario = new Usuario(
                $usuarioDB['T01_CodUsuario'],
                $usuarioDB['T01_Password'],
                $usuarioDB['T01_DescUsuario'],
                $usuarioDB['T01_NumConexiones'],
                $oFechaValida,
                null,
                $usuarioDB['T01_Perfil'],
                $usuarioDB['T01_ImagenUsuario']);
            return $oUsuario;
        } catch (Exception $ex) {
            // En caso de error, devolvemos null.
            echo $ex->getMessage();
            return null;
        }
    }
    
    /**
     * Método buscarUsuarioPorDesc
     * 
     * Busca mediante una sentencia SELECT a un usuario dada
     * una descripción.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 05/02/2026
     * @param (string) $descusuario atributo descripción del objeto usuario
     * @return (Collection) colección de objetos de la clase usuario
     */
    
    public static function buscarUsuariosPorDesc($descUsuario){
        $sql = <<<SQL
            SELECT * FROM T01_Usuario
            WHERE T01_DescUsuario LIKE :descUsuario
        SQL;
        $aUsuarios = null;
        try{
            // Ejecutamos la busqueda en la base de datos.
            $consulta = DBPDO::ejecutaConsulta($sql, [':descUsuario' => "%$descUsuario%"]);
            // El resultado de la consulta lo guardamos en una colección.
            while ($oUsuario = $consulta->fetchObject()) {
                $aUsuarios[] = new Usuario(
                    $oUsuario->T01_CodUsuario,
                    $oUsuario->T01_Password,
                    $oUsuario->T01_DescUsuario,
                    $oUsuario->T01_NumConexiones,
                    $oUsuario->T01_FechaHoraUltimaConexion,
                    null,
                    $oUsuario->T01_Perfil,
                    $oUsuario->T01_ImagenUsuario
                );
            }
            return $aUsuarios;  
        } catch(Exception $ex){
            return null;
        }
    }
    
    
    /**
     * Método actualizarUltimaConexionUsuario
     * 
     * Actualiza el atributo ultimaConexionUsuario del objeto Usuario
     * con el valor de la fecha en el momento de hacer login.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 22/01/2026
     * @param (Usuario) objeto de la clase usuario.
     * @return (Usuario) objeto de la clase usuario.
     */
    public static function actualizarUltimaConexionUsuario($codUsuario) {
        $oUsuario = self::buscarUsuarioPorCod($codUsuario);
        $fechaAnterior = $oUsuario->getFechaHoraUltimaConexion();
        $sql = <<<SQL
            UPDATE T01_Usuario SET
                T01_FechaHoraUltimaConexion = NOW(),
                T01_NumConexiones = T01_NumConexiones + 1
            WHERE T01_CodUsuario = :usuario
        SQL;

        try{
            // Ejecutamos la actualización en la BD.
            $consulta = DBPDO::ejecutaConsulta($sql, [':usuario' => $codUsuario]);
            
            if($consulta){
                $oUsuario = self::buscarUsuarioPorCod($codUsuario);
                // Actualizamos el objetos Usuario en memoria.
                // La fecha actual que tenía ahora pasa a ser la anterior.
                $oUsuario->setFechaHoraUltimaConexionAnterior($fechaAnterior);
                return $oUsuario;
            } else{
                return null;
            } 
        } catch (Exception $ex){
            return null;
        }
    }

    /**
     * Método altaUsuario
     * 
     * Crear un nuevo usuario y guardarlo en la base de datos
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 22/01/2026
     * @param (string) Código del usuario.
     * @param (string) Contraseña del usuario.
     * @param (string) Descripción (nombre) del usuario.
     * @return (Usuario) objeto de la clase usuario.
     */
    public static function altaUsuario($codUsuario, $password, $descUsuario) {
        // Creamos un objeto usuario pero inicializado a null.
        $oUsuario = null;

        // Ceramos y definimos una variable con la consulta de insercción para crear un usuario.
        $sql = <<<SQL
            INSERT INTO T01_Usuario
                (T01_CodUsuario, T01_Password, T01_DescUsuario,
                T01_FechaHoraUltimaConexion, T01_NumConexiones, T01_Perfil)
            VALUES
                (:codUsuario, SHA2(:password, 256), :descUsuario, now(), 1, 'usuario')
        SQL;

        try {
            $consulta = DBPDO::ejecutaConsulta($sql,
                            [':codUsuario' => $codUsuario,
                                ':password' => $codUsuario . $password,
                                ':descUsuario' => $descUsuario]);
            if ($consulta) {
                $oUsuario = self::validarUsuario($codUsuario, $password);
            }
        } catch (Exception $ex) {
            return null;
        }

        return $oUsuario;
    }

    /**
     * Método modificarUsuario
     * 
     * Actualiza la información del usuario mediante una consulta a la base de datos
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 26/01/2026
     * @param (Usuario) objeto de la clase Usuario.
     * @param (string) descripción nueva del usuario.
     * @return (Usuario) objeto de la clase Usuario.
     */
    public static function modificarUsuario($codUsuario, $descUsuarioNuevo) {

        // Ceramos y definimos una variable con la consulta de insercción para crear un usuario.
        $sql = <<<SQL
            UPDATE T01_Usuario
                SET T01_DescUsuario = :descUsuario
                WHERE T01_CodUsuario = :codUsuario
        SQL;
        
        try {
            $consulta = DBPDO::ejecutaConsulta($sql,
                            [':descUsuario' => $descUsuarioNuevo,
                            ':codUsuario' => $codUsuario]);
            
            if ($consulta) {
                return self::buscarUsuarioPorCod($codUsuario);
            } else{
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    /**
     * Método modificarContraseña.
     * 
     * Cambiar la contraseña del usuario.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 26/01/2026
     * @param (Usuario) objeto de la clase Usuario.
     * @param (string) contraseña nueva del usuario.
     * @return (Usuario) objeto de la clase Usuario. 
     */
    public static function modificarContraseña($codUsuario, $passwordNueva){
         // Ceramos y definimos una variable con la consulta de insercción para crear un usuario.
        $sql = <<<SQL
            UPDATE T01_Usuario
                SET T01_Password = SHA2(:password, 256)
                WHERE T01_CodUsuario = :codUsuario
        SQL;
        
        try {
            $consulta = DBPDO::ejecutaConsulta($sql,
                            [':password' => $codUsuario.$passwordNueva,
                            ':codUsuario' => $codUsuario]);
            
            if ($consulta) {
                return self::buscarUsuarioPorCod($codUsuario);
            } else{
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
    
    /**
     * Método borrarUsuario.
     * 
     * Eliminar el usuario de la base de datos (darlo de baja física).
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 26/01/2026
     * @param (Usuario) objeto de la clase Usuario.
     * @return (boolean) true: ha funcionado la ejecución. false: no ha funcionado la ejecución.
     */
    public static function borrarUsuario($codUsuario){
        $sql = <<<SQL
            DELETE FROM T01_Usuario
            WHERE T01_codUsuario = :codUsuario
        SQL;
        
        try{
            $consulta = DBPDO::ejecutaConsulta($sql, [
                ':codUsuario' => $codUsuario
            ]);
            
            if($consulta->rowCount() > 0){
                return true;
            }
        } catch (Exception $ex){
            return false;
        }
        
        return false;
    }

    /**
     * Método validarCodNoExiste.
     * 
     * Comprobar que el código introducido no pertenece a ningún usuario.
     * 
     * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
     * @since 27/01/2026
     * @param (string) Código de usuario.
     * @return (boolean) true: el código no pertenece a ningún usuario. false: el código si pertenece a un usuario.
     */
    public static function validarCodNoExiste($codUsuario) {
        $sql = <<<SQL
            SELECT T01_CodUsuario FROM T01_Usuario
            WHERE T01_CodUsuario = :usuario
        SQL;

        try {
            // Ejecutar la consulta. 
            $consulta = DBPDO::ejecutaConsulta($sql, [
                        ':usuario' => $codUsuario]);

            // Obtener el resultado de la consulta.
            $usuarioDB = $consulta->fetch(PDO::FETCH_ASSOC);

            // Si no existe el usuario o la contraseña es incorrecta, devolvemos null.
            if (!$usuarioDB) {
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

?>