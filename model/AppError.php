<?php

/*
 * @author Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since 15/01/2026
 */


class AppError{
    private $codError;
    private $descError;
    private $archivoError;
    private $lineaError;
    private $paginaSiguiente;
    
    public function __construct($codError, $descError, $archivoError, $lineaError, $paginaSiguiente){
        $this->codError = $codError;
        $this->descError = $descError;
        $this->archivoError = $archivoError;
        $this->lineaError = $lineaError;
        $this->paginaSiguiente = $paginaSiguiente;
    }
    
    public function getCodError(){
        return $this->codError;
    }
    
    public function getDescError(){
        return $this->descError;
    }
    
    public function getArchivoError(){
        return $this->archivoError;
    }
    
    public function getLineaError(){
        return $this->lineaError;
    }
    
    public function getPaginaSiguiente(){
        return $this->paginaSiguiente;
    }
    
    public function setCodError($codError){
        $this->codError = $codError;
    }
    
    public function setDescError($descError){
        $this->descError = $descError;
    }
    
    public function setArchivoError($archivoError){
        $this->archivoError = $archivoError;
    }
    
    public function setLineaError($lineaError){
        $this->lineaError = $lineaError;
    }
    
    public function setPaginaSiguiente($paginaSiguiente){
        $this->paginaSiguiente = $paginaSiguiente;
    }
}
