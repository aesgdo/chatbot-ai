<?php // target : openai-update_apikey

    $result = [
        "message"       => "Error: Faltan parametros.",            
        "error_code"    => 403,            
    ];

    if ( function_exists('on_exception_server_response') ) {

        $apikey = isset($array_data['apikey']) ? $array_data['apikey'] : null;

        // guardamos el modelo en la base de datos, sino existe lo creamos
        $response = update_option('chatbot_ai_openai_api_key', $apikey);

        if ( ! $response ) {

            on_exception_server_response( 403, [
                "message"       => arr_multi_lang("Error: No se ha podido actualizar la apikey."),
                "target"        => $target,
                "error_code"    => 403,
                "data"          => [],
                "send_result"   => true,
            ]);

        }        
            
        $result = [
            "message"       => "APIKey actualizado.",
            "error_code"    => 200,
            "status"        => "OK",
        ];

    };



    header('Content-Type: application/json');
     // creamos el objeto json con json_encode (JSON_UNESCAPED_UNICODE evitar que cambie las vocales asentuadas)
    $result = ( count($result) > 0 ) ? json_encode($result,JSON_UNESCAPED_UNICODE) : "";            
    echo $result;