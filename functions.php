<?php

/**
 * Este archivo contiene la carga de los archivos de funciones del plugin.
 * Se carga en el archivo principal del plugin.
 */

 /**
  * Esta funcion incluye los archivos de funciones que se encuentran en el directorio src/actions y src/filters
  */
function include_files($files){

    if (isset($files) && is_array($files)) {
        for ($i=0; $i < count($files); $i++) { 
            include($files[$i]);
        }        
    }
    return;
}

// array con el nombre de los path a cargar
$array_path = ['actions', 'filters'];

foreach ($array_path as $path) {    
    // glob devuelve un array con los nombres de los archivos que cumplen con el patron
    // ex. $patron = plugin_dir_path(__FILE__).'/actions/*.php'; // Patron de busqueda
    $files = glob( plugin_dir_path(__FILE__).'/src/'.$path.'/*.php' );
    include_files($files);
}

/**
     * Devuelve el codigo de respuesta del servidor especificado y un json con datos.
     * 
     * @param int    $http_response_code        Codigo que el servidor devolvera en la cabecera de respuesta
     * @param string $message <opcional>        Mensaje que acompaña la respuesta
     * @param bool   $send_result <opcional>    Si es false no devuelve el resultado solo el codigo en la cabecera
     * 
     * @return json  Devuelve un objeto json con las respuestas establecidas.   
     */
    function on_exception_server_response( 
        $http_response_code, 
        array $options = [])
    {
        
        $default = [ 
            "message"       => [] , 
            "target"        => "",
            "error_code"    => 0, 
            "data"          => [], 
            "send_result"   => true,
            "status"        => $http_response_code,
        ];

        // array_merge combina dos o mas arrays, si hay coincidencias en las claves del array el valor del segundo array reemplaza el primero.
        $opt = array_merge($default, $options);

        // si el mensaje es un array y no tiene elementos    
        if ( is_array($opt['message']) && count($opt['message']) == 0)
        {
            $msg = "Ejecucion incorrecta.";

            $message = arr_multi_lang($msg);            

        }
        else
        {
            $message['lang_es'] = isset($message['lang_es']) ? $message['lang_es'] : 'Ejecucion incorrecta.';
            $message['lang_en'] = isset($message['lang_en']) ? $message['lang_en'] : 'Incorrect execution.';
            $message['lang_fr'] = isset($message['lang_fr']) ? $message['lang_fr'] : 'Exécution incorrecte.';
        }

        // server codigos : 200, 403 , 409 , etc
        http_response_code($http_response_code);
    
        header('Content-Type: application/json');

        $opt['status'] = isset($opt['status']) ? $opt['status'] : strval($http_response_code);

        if ( $opt['send_result'] )
        {
            $result = [
                'data'          => $opt['data'],
                'error_code'    => (string)$opt['error_code'],
                'message'       => $opt['message'],
                'status'        => $opt['status'],                
                'target'        => (string)$opt['target'],
            ];
            // creamos el objeto json con json_encode (JSON_UNESCAPED_UNICODE evitar que cambie las vocales asentuadas)
            $result = ( count($result) > 0 ) ? json_encode($result,JSON_UNESCAPED_UNICODE) : "";            
            echo $result;

        }

    }

    /**
     * Esta función recibe una cadena y la traduce al idioma seleccionado
     */
    function _lang($string = "", $lang = CHATBOT_AI_LANG ){
        

        if ( isset($_SESSION['LANG_TO_TRASLATE']) || isset($lang) )
        {
            $lang = isset($_SESSION['LANG_TO_TRASLATE']) ? $_SESSION['LANG_TO_TRASLATE'] : $lang;
            //var_dump($_SESSION['LANG_TO_TRASLATE']);
            
            $lang_file = get_lang_file($lang);
            
            if ( $lang_file !== false ){                    
                $string = get_traduction($string, $lang_file );                                
            }
        }        
                
        return $string;
    }

    /**
     * Esta funcion retorna el archivo con las traducciones solicitadas
     */
    function get_lang_file($lang, $default = CHATBOT_AI_LANG ){

        $lang = isset($lang) ? $lang : $default;
        
        // recorre el directorio de idiomas buscando el idioma solicitado        
        foreach ( glob(  CHATBOT_AI_BASE_PATH . '/languages/*.lang') as $filename){             
            if ( strpos($filename , $lang . ".lang") > -1){
                return $filename;
            }            
        }

        return false;            

    }

    /**
     * Devuelve la traduccion solicitada si la encuentra, de los contrario la cadena original
     */
    function get_traduction($string, $lang_file )
    {

        // si es un archivo
        if ( is_file($lang_file) )
        {

            $lang_file_opened = fopen( $lang_file , 'r' );
            
            while( !feof($lang_file_opened) ) {
                
                $getLine = fgets($lang_file_opened);
                
                $array_with_traduccion = explode( "|" , $getLine );
                
                // el array tiene 2 posiciones
                if (count($array_with_traduccion) == 2){

                    foreach ($array_with_traduccion as $key => $value) {  
                        // si las cadenas coinciden                      
                        if ( trim($value) == trim($string) )
                        {
                            fclose($lang_file_opened);
                            // devuelve la traduccion
                            return trim($array_with_traduccion[1]);                            
                        }    
                    }
                }

            }

            fclose($lang_file_opened);
        }

        return $string;
    }

    /**
     * Devuelve un array con varias traducciones, recibe un string
     */
    function arr_multi_lang($msg)
    {
        $message = [
            'lang_es' => _lang($msg,'es_ES'),
            'lang_en' => _lang($msg,'es_EN'),
            'lang_fr' => _lang($msg,'es_FR'),
        ]; 

        return $message;

    }