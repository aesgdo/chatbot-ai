<?php // target: openai-completions

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
    
        $openai_api_key = get_option('chatbot_ai_openai_api_key');
        
        $model = get_option('chatbot_ai_openai_model');

        $system_role_content = htmlspecialchars(trim(get_option('chatbot_ai_openai_agent_prompt')));

        $result = chatbot_ai_openai_completions( $openai_api_key , $array_messages, $model,  $system_role_content);
        
        if ( isset($result['error_code']) ) {
            on_exception_server_response( 403, [
                "message"       => arr_multi_lang("Lo siento, no puedo atenderte en estos momentos. Intentalo más tarde."),
                "target"        => $target,
                "error_code"    => $result['error_code'],
                "data"          => [],
                "send_result"   => true,
            ]);            
            exit;
        }


        if ( isset($result['choices'][0]['message']['content']) ) {
            $result = [
                "message"       => arr_multi_lang($result['choices'][0]['message']['content']),
                "error_code"    => 200,
                "status"        => "OK",
                "target"        => $target,
            ];
        } 

    }

    
    header('Content-Type: application/json');
     // creamos el objeto json con json_encode (JSON_UNESCAPED_UNICODE evitar que cambie las vocales asentuadas)
    $result = ( count($result) > 0 ) ? json_encode($result,JSON_UNESCAPED_UNICODE) : "";            
    echo $result;