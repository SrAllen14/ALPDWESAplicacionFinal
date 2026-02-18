<?php

/**
 * Class REST
 * 
 * Interactua con las diferentes APIs recibiendo la información y enviándola al controlador.
 * 
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
    
    /*public static function apiPaisesInfo($nombrePais){
        $url = "https://restcountries.com/v3.1/name/" . urlencode($nombrePais);

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (!empty($data)) {
            $pais = $data[0];
            $idioma = array_keys($pais['name']['nativeName']);
            $oPaisInfo = new PaisesInfo($pais['name']['nativeName'][$idioma[0]]['common'],  $pais['population'], $pais['capital'][0], $pais['area']);
            return $oPaisInfo;
        } else {
            return null;
        }
    }*/
    
    public static function apiPaisesInfo($nombrePais){
        // Endpoint de la API
        $url = "https://restcountries.com/v3.1/name/" . urlencode($nombrePais);
        
        // Iniciar cURL
        $curl = curl_init();
        
        // Configurar opciones
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 10
        ]);
        
        // Ejecutar y obtener respuesta
        $response = curl_exec($curl);
        
        // Cerrar cURL
        curl_close($curl);
        
        // Convertir JSON a array
        $data = json_decode($response, true);
        
        // Comprobar errores
        if (!$data) {
            echo "Error al obtener datos o país no encontrado.";
            exit;
        }
        
        if (!empty($data)) {
            $pais = $data[0];
            $idioma = array_keys($pais['name']['nativeName']);
            $oPaisInfo = new PaisesInfo($pais['name']['nativeName'][$idioma[0]]['common'],  $pais['population'], $pais['capital'][0], $pais['area']);
            return $oPaisInfo;
        } else {
            return null;
        }
        
    }
    
    public static function apiDepartamentos($codDepartamento = 'DWA'){
        $error = false;
        $url = 'http://alvaroallper.ieslossauces.es/ALPDWESAplicacionFinal/api/wsVolumenDeDepartamentoPorCodigo.php?codDepartamento=';
        
        $resultado = file_get_contents($url.$codDepartamento);
        $archivoApi = json_decode($resultado, true);
        
        if(isset($archivoApi)){
            $oDepartamento = new Departamento(
                $archivoApi['codDepartamento'], 
                $archivoApi['descDepartamento'], 
                $archivoApi['fechaCreacionDepartamento'],
                $archivoApi['volumenNegocio'],
                $archivoApi['fechaBajaDepartamento']
            );
            return $oDepartamento;
        } else{
            return null;
        }
    }
}