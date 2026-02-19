<?php

/**
 * Clase PaisesInfo.
 * 
 * Representa un país recibido con su nombre, población y superficie
 * 
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 18/02/2026
 * @version 1.0
 */

class PaisesInfo{
    private $nombre;
    private $poblacion;
    private $capital;
    private $area;
    
    public function __construct($nombre, $poblacion, $capital, $area) {
        $this->nombre = $nombre;
        $this->poblacion = $poblacion;
        $this->capital = $capital;
        $this->area = $area;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getPoblacion(){
        return $this->poblacion;
    }
    
    public function getCapital(){
        return $this->capital;
    }
    
    public function getArea(){
        return $this->area;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function setPoblacion($poblacion){
        $this->poblacion = $poblacion;
    }
    
    public function setCapital($capital){
        $this->capital = $capital;
    }
    
    public function setArea($area){
        $this->area = $area;
    }
}