<?php

/**
 * Web Service BuscarUsuariosPorDescripcion
 * 
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 05/02/2026
 */

require_once '../model/Usuario.php';
require_once '../model/UsuarioPDO.php';
require_once '../model/DBPDO.php';
require_once '../config/confDBPDO.php';


$entradaOk = true;

if($entradaOk){
    $aUsuariosDevueltos = UsuarioPDO::buscarUsuariosPorDesc('');
    $amUsuarios = [];
    
    if($aUsuariosDevueltos){
        foreach ($aUsuariosDevueltos as $oUsuario) {
            $amUsuarios[] = [
                'codUsuario' => $oUsuario->getCodUsuario(),
                'password' => $oUsuario->getPassword(),
                'descUsuario' => $oUsuario->getDescUsuario(),
                'contadorAccesos' => $oUsuario->getContadorAccesos(),
                'fechaHoraUltimaConexion' => $oUsuario->getFechaHoraUltimaConexion(),
                'fechaHoraUltimaConexionAnterior' => $oUsuario->getFechaHoraUltimaConexionAnterior(),
                'perfil' => $oUsuario->getPerfil(),
                'imagenUsuario' => $oUsuario->getImagenUsuario()
            ];
        }
    }
    echo json_encode($amUsuarios, JSON_PRETTY_PRINT);
}

?>