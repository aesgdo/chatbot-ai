<?php      
    
    $json = file_get_contents('php://input');
    $array_data = json_decode($json, true);
    $target = isset($array_data['target']) ? $array_data['target'] : null;


    if ( $_SERVER['REQUEST_METHOD'] !== 'POST') {

        on_exception_server_response( 403, [
            "message"       => arr_multi_lang("Error: Faltan parametros."),
            "target"        => $target,
            "error_code"    => 403,
            "data"          => [],
            "send_result"   => true,
        ]);
        exit;
    }
    
    switch ($target) {
        case 'openai_completions':
            include_once( './controllers/OpenAIChat.php' );
            break;
        
        default:
            # code...
            break;
    }