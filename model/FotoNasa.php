<?php

/**
 * Clase FotoNasa.
 * 
 * Representa una foto recibida de la Nasa con su título, su url y urlHD, su fecha, sus detalles y posibles errores de ejecución.
 * 
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 19/01/2026
 * @version 1.0
 */
class FotoNasa{
    private $titulo;
    private $url;
    private $urlHD;
    private $fecha;
    private $explicacion;
    private $error;
    
    public function __construct($titulo, $url, $urlHD ,$fecha, $explicacion, $error) {
        $this->titulo = $titulo;
        $this->url = $url;
        $this->urlHD = $urlHD;
        $this->fecha = $fecha;
        $this->explicacion = $explicacion;
        $this->error = $error;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function getUrl(){
        return $this->url;
    }
    
    public function getUrlHD(){
        return $this->urlHD;
    }
    
    public function getFecha(){
        return $this->fecha;
    }
    
    public function getExplicacion(){
        return $this->explicacion;
    }
    
    public function getError(){
        return $this->error;
    }
    
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    public function setUrl($url){
        $this->url = $url;
    }
    public function setUrlHD($urlHD){
        $this->urlHD = $urlHD;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setExplicacion($explicacion){
        $this->explicacion = $explicacion;
    }
}