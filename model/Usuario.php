<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change $this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit $this template
 */

class Usuario{
    private $codUsuario;
    private $password;
    private $descUsuario;
    private $contadorAccesos;
    private $fechaHoraUltimaConexion;
    private $fechaHoraUltimaConexionAnterior;
    private $perfil;
    private $imagenUsuario;
    
    
    public function __construct($codUsuario, $password, $descUsuario, $contadorAccesos, $fechaHoraUltimaConexion, $fechaHoraUltimaConexionAnterior, $perfil, $imagenUsuario){
        $this->codUsuario = $codUsuario;    
        $this->descUsuario = $descUsuario;
        $this->password = $password;
        $this->contadorAccesos = $contadorAccesos;
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
        $this->perfil = $perfil;
        $this->imagenUsuario = $imagenUsuario;
    }
    
    public function getCodUsuario(){
        return $this->codUsuario;
    }
    
    public function getDescUsuario(){
        return $this->descUsuario;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function getPerfil(){
        return $this->perfil;
    }
    
    public function getFechaHoraUltimaConexion(){
        return $this->fechaHoraUltimaConexion;
    }
    
    public function getFechaHoraUltimaConexionAnterior(){
        return $this->fechaHoraUltimaConexionAnterior;
    }
    
    public function getContadorAccesos(){
        return $this->contadorAccesos;
    }
    
    public function getImagenUsuario(){
        return $this->imagenUsuario;
    }
    
    public function setCodUsuario($codUsuario){
        $this->codUsuario = $codUsuario;
    }
    
    public function setDescUsuario($descUsuario){
        $this->descUsuario = $descUsuario;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }
    
    public function setFechaHoraUltimaConexion($fechaHoraUltimaConexion){
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
    }
    
    public function setFechaHoraUltimaConexionAnterior($fechaHoraUltimaConexionAnterior){
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
    }
    
    public function setContadorAccesos($contadorAccesos){
        $this->contadorAccesos = $contadorAccesos;
    }
    
    public function setImagenUsuario($imagenUsuario){
        $this->imagenUsuario = $imagenUsuario;
    }
}
?>