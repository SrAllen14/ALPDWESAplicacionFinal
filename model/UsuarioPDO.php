<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'DBPDO.php';
require_once 'Usuario.php';
class UsuarioPDO{
    public static function validarUsuario($codUsuario, $password){
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
        try{
          // Ejecutar la consulta. 
          $consulta = DBPDO::ejecutaConsulta($sql, [
              ':usuario' => $codUsuario, 
              ':password' => $codUsuario . $password]);  
          
          // Obtener el resultado de la consulta.
          $usuarioDB = $consulta->fetch(PDO::FETCH_ASSOC);
          
          // Si no existe el usuario o la contraseña es incorrecta, devolvemos null.
          if(!$usuarioDB){
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
        
          if(is_null($oUsuario)){
              
          }
          return $oUsuario;
        } catch(Exception $ex){
            // En caso de error, devolvemos null.
            echo $ex->getMessage();
            return null;
        }
    }
    
    public static function actualizarUltimaConexionUsuario($oUsuario){
        $sql = <<<SQL
            UPDATE T01_Usuario SET
                T01_FechaHoraUltimaConexion = NOW(),
                T01_NumConexiones = T01_NumConexiones + 1
            WHERE T01_CodUsuario = :usuario
        SQL;
        
        // Ejecutamos la actualización en la BD.
        DBPDO::ejecutaConsulta($sql, [':usuario'=>$oUsuario->getCodUsuario()]);
        
        // Actualizamos el objetos Usuario en memoria.
        // La fecha actual que tenía ahora pasa a ser la anterior.
        $oUsuario->setFechaHoraUltimaConexionAnterior($oUsuario->getFechaHoraUltimaConexion());
        
        // Incrementamos el número de accesos.
        $oUsuario->setContadorAccesos($oUsuario->getContadorAccesos()+1);
        
        // Establecer la nueva fecha de conexión.
        date_default_timezone_set('Europe/Madrid');
        $oUsuario->setFechaHoraUltimaConexion(new DateTime());
        
        return $oUsuario;
    }
    
    public static function altaUsuario(){
        
    }
    
    public static function modificarUsuario(){
        
    }
    
    public static function borrarUsuario(){
        
    }
    
    public static function validarCodNoExiste(){
        
    }
}
?>