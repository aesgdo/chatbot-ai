<?php


/**
 * Esta funcion se comunica con la API de OpenAI para obtener una respuesta a partir de un mensaje.
 * Se utiliza el modelo gpt-4.1 por defecto, pero se puede cambiar el modelo si se desea.
 */
function chatbot_ai_openai_completions($OPENAI_API_KEY, $messages, $model = "o4-mini", $system_role_content = "Eres un asistente útil.") {
    
    if (empty($model)) {
        $model = "o4-mini"; // Modelo por defecto
    }

    // Modelos disponibles
    // $models = ["o4-mini","gpt-4.1","gpt-4.1-mini", "gpt-4.1-nano", "gpt-4o-mini", "o1-mini", "o3-mini"];

    $url = OPENAI_API_URL; // URL de la API de OpenAI -> ver settings.php    


    // para mantener el contexto se debe enviar el mensaje anterior y la respuesta del asistente
    // el mensaje del usuario se puede enviar como un solo string o como un array de mensajes
    /*$messages = [
        ["role" => "system", "content" => "Eres un experto en historia."],
        ["role" => "user", "content" => "¿Quién fue Napoleón?"],
        ["role" => "assistant", "content" => "Napoleón Bonaparte fue un líder militar y emperador francés que vivió entre 1769 y 1821."],
        ["role" => "user", "content" => "¿Y qué pasó con él en Waterloo?"]
    ];*/
    

    $data = [
        "model" => $model,
        "messages" => [
            [
                "role" => "system", 
                "content" => $system_role_content
            ],
            /* [
                "role" => "user", 
                "content" => $messages
            ] */
        ],
        "temperature" => 0.3, // Controla la aleatoriedad de la respuesta 0.0 a 1.0 (1.0 es mas creativo y aleatorio)
        //"top_p" => 1, // Controla la diversidad de la respuesta 0.0 a 1.0
        //"frequency_penalty" => 0, // Penaliza la repetición de palabras 0.0 a 2.0
        //"max_tokens" => 1000, // Número máximo de tokens en la respuesta
    ];
    
    $data["messages"] = array_merge($data["messages"], $messages); // Agrega los mensajes del usuario al array de mensajes

    //return $data;

    $ch = curl_init($url); // Inicia la sesión cURL

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Devuelve la respuesta como string

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desactiva la verificación del certificado SSL (no recomendado en producción)

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $OPENAI_API_KEY,
    ]);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch); // Ejecuta la solicitud cURL

    if (curl_errno($ch)) {
        // Manejo de errores
        echo 'Error:' . curl_error($ch);
    } else {

        $response_data = json_decode($response, true); // Decodifica la respuesta JSON


        if (isset($response_data['error'])) {
            
            $response = [
                "message"       => "Error: " . $response_data['error']['message'],
                "error_code"    => $response_data['error']['code'],                
            ];

            return $response;
        }        

        if (isset($response_data['choices'][0]['message']['content'])) {

            return $response_data['choices'][0]['message']['content']; // Devuelve el contenido de la respuesta

        } else {

            $response = [
                "message"       => "Error: No se pudo obtener una respuesta válida.",
                "error_code"    => 500,
            ];

            return $response;
        }
    }

    curl_close($ch); // Cierra la sesión cURL
}