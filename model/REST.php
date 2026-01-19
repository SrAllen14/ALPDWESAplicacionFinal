<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 19/01/2026
 */

class REST{
    const API_KEY_NASA = 'uzpJUwOHnBD391Xblgeh1wiMDprUWeP91FRkajuI';
    
    public static function apiNasa($fecha){
        // Se accede a la URL de la nasa.
        $resultado = file_get_contents($url = "https://api.nasa.gov/planetary/apod?api_key=".self::API_KEY_NASA);
        $archivoApi = json_decode($resultado, true);
        
        if(isset($archivoApi)){
            $fotoNasa = new FotoNasa($archivoApi['title'], $archivoApi['url'], $archivoApi['date'], $archivoApi['explanation']);
            return $fotoNasa;
        }
    }
}