<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es 
 * @since: 19/01/2026
 */

class FotoNasa{
    private $titulo;
    private $url;
    private $fecha;
    private $explicacion;
    
    public function __construct($titulo, $url, $fecha, $explicacion) {
        $this->titulo = $titulo;
        $this->url = $url;
        $this->fecha = $fecha;
        $this->explicacion = $explicacion;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function getUrl(){
        return $this->url;
    }
    
    public function getFecha(){
        return $this->fecha;
    }
    
    public function getExplicacion(){
        return $this->explicacion;
    }
}