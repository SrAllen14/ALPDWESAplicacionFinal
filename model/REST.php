<?php

/*
 * @author: Álvaro Allén alvaro.allper.1@educa.jcyl.es
 * @since: 19/01/2026
 */

class REST{
    /*
    public static function apiNasa($fecha){
        $error = false;
        // Se accede a la URL de la nasa.
        $resultado = file_get_contents($url = "https://api.nasa.gov/planetary/apod?date=$fecha&api_key=".API_KEY_NASA);
        $archivoApi = json_decode($resultado, true);
        
        if(empty($archivoApi['url'])){
            $url = '';
            $error = true;
        } else{
            $url = $archivoApi['url'];
        }
        
        if(empty($archivoApi['hdurl'])){
            $urlHD = '';
        } else{
            $urlHD = $archivoApi['hdurl'];
        }
        
        if(isset($archivoApi)){
            $fotoNasa = new FotoNasa($archivoApi['title'], $url, $urlHD ,$archivoApi['date'], $archivoApi['explanation'], $error);
            return $fotoNasa;
        }
    }
    
    */
    // Código cedido por Vero Grue
    public static function apiNasa($fecha) {
        $error = false;
    
        $url = "https://api.nasa.gov/planetary/apod?date=$fecha&api_key=" . API_KEY_NASA;
    
        if (!function_exists('curl_init')) {
            // cURL no disponible, devolvemos objeto vacío
            return new FotoNasa('', '', '', '', '', true);
        }
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // Conexión 5s
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);        // Tiempo máximo 5s
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) PHP-App');
    
        $resultado = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($resultado === false || $httpCode !== 200) {
            return new FotoNasa('', '', '', '', '', true);
        }
    
        $archivoApi = json_decode($resultado, true);
    
        if (($archivoApi['media_type'] ?? '') !== 'image') {
            $error = true;
            $urlImg = '';
            $urlHD = '';
        } else {
            $urlImg = $archivoApi['url'] ?? '';
            $urlHD = $archivoApi['hdurl'] ?? '';
        }
    
        return new FotoNasa(
            $archivoApi['title'] ?? '',
            $urlImg,
            $urlHD,
            $archivoApi['date'] ?? '',
            $archivoApi['explanation'] ?? '',
            $error
        );
    }
}