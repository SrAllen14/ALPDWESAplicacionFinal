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
        try{
            // URL de la API de NASA con la clave y la fecha
            $url = "https://api.nasa.gov/planetary/apod?api_key=". self::API_KEY_NASA ."&date=$fecha";

            // Inicializar cURL (una librería de PHP para hacer peticiones HTTP más robustas). 
            // https://www.php.net/manual/es/book.curl.php
            $ch = curl_init();

            // Configurar las opciones de cURL
            curl_setopt($ch, CURLOPT_URL, $url);                    // URL a la que hacer la petición
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);         // Devolver el resultado en lugar de imprimirlo
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);         // Seguir redirecciones si las hay
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);                  // Tiempo máximo de espera total (10 segundos)
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);           // Tiempo máximo para conectar (10 segundos)
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);         // Verificar el certificado SSL
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);            // Verificar que el certificado coincide con el host
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) PHP-App'); // Identificarse como navegador

            // Ejecutar la petición
            $resultado = curl_exec($ch);

            // Obtener el código HTTP de respuesta (200 = OK, 404 = No encontrado, etc.)
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Cerrar la conexión cURL
            // curl_close($ch); está deprecated. Ahora ya no se utiliza

            // Si la petición falló o el código HTTP no es 200 (OK), retornar null
            if ($resultado === false || $httpCode !== 200) {
                return null;
            }

            // Decodificar el JSON recibido y convertirlo en un array de PHP
            $archivoApi = json_decode($resultado, true);

            // Si el JSON tiene los datos necesarios, crear el objeto FotoNasa. Si solo se pone if(isset($archivoApi)), devuelve siempre algo aunque no haya datos
            if(isset($archivoApi['title'])){
                $fotoNasa = new FotoNasa(
                $archivoApi['title'],
                $archivoApi['url'] ?? null,
                $archivoApi['hdurl'] ?? null,
                $archivoApi['date'],
                $archivoApi['explanation']
            );
                return $fotoNasa;
            }
            // Si no se pudo obtener la foto, retornar null
            return null;
        } catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
}