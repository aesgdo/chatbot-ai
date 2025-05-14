<?php // target: openai_completions

    $result = [
        "message"       => "Error: Faltan parametros.",            
        "error_code"    => 403,            
    ];

    if ( function_exists('on_exception_server_response') ) {

        $array_messages = isset($array_data['chat']) ? $array_data['chat'] : null;
    
        if ( empty($array_messages) || !is_array($array_messages) ) {
                    
            on_exception_server_response( 403, [
                "message"       => arr_multi_lang("Error: Faltan parametros."),
                "target"        => $target,
                "error_code"    => 403,
                "data"          => [],
                "send_result"   => true,
            ]);            
            exit;
        }
    
        
        $result = chatbot_ai_openai_completions( OPENAI_API_KEY , $array_messages, $model = "o4-mini");

    }

    
    header('Content-Type: application/json');
     // creamos el objeto json con json_encode (JSON_UNESCAPED_UNICODE evitar que cambie las vocales asentuadas)
    $result = ( count($result) > 0 ) ? json_encode($result,JSON_UNESCAPED_UNICODE) : "";            
    echo $result;