
/**
 * Esta funcion se encarga de enviar el mensaje al servidor
 * y recibir la respuesta del chatbot
 * @param {array} array_chat 
 */
const sendMessageToChatbot = async (array_chat) => {

    const url = './wp-content/plugins/chatbot-ai/src/api/index.php';

    const data = {
        chat   : array_chat,
        target : 'openai_completions',
    };
    
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body : JSON.stringify(data),        
    };

    //console.log(options);
    //console.log(array_chat);
    
    const server = await fetch(url, options);
    const response = await server.json();


    console.log(server.status);

    if (server.status === 200) {

        if (typeof response.error_code !== 'undefined' && ( response.error_code === 'insufficient_quota' || response.error_code === 'invalid_api_key' ) ) {
            
            let message = "Lo siento, no puedo atenderte en estos momentos. Intentalo más tarde.";

            // TO DO: enviar mensaje de error al administrador
            // sendErrorMessageToAdmin(response.error_message);

            // enviar mensaje al usuario
            enqueueChatBotMessages(message);    

        }

    }
    

}

/**
 * Esta funcion agrega el mensaje del usuario a la cola de mensajes
 * esta cola es un array que se va llenando con los mensajes del usuario y el bot
 * @param {string} bot_message 
 */
const enqueueChatBotMessages = (bot_message) => {
       
    let array_chat = [];

    if (
        typeof localStorage.chat === 'undefined' || 
               localStorage.chat === 'null'      || 
               localStorage.chat === ""
       ){

        array_chat = [
            {
                "role"      : "assistant",               
                "content"   : bot_message
            },
        ];

        localStorage.chat = JSON.stringify(array_chat);

    }
    else{

        array_chat = JSON.parse(localStorage.chat);

        const new_msg_obj = {"role":"assistant","content":bot_message};

        array_chat[array_chat.length] = new_msg_obj;

        localStorage.chat = JSON.stringify(array_chat);
        
    }

    handleBotInput(bot_message);

}

/**
 * Esta funcion agrega el mensaje del usuario a la cola de mensajes
 * esta cola es un array que se va llenando con los mensajes del usuario y el bot
 * @param {string} user_message 
 */
const enqueueUserMessages = (user_message) => {
       
    let array_chat = [];

    if (
        typeof localStorage.chat === 'undefined' || 
               localStorage.chat === 'null'      || 
               localStorage.chat === ""
       ){

        array_chat = [
            {
                "role"      : "assistant",
                "content"   : "Hola, soy un asistente virtual. ¿Cuál es tu nombre?"
            },
            {
                "role"      : "user",
                "content"   : user_message
            },
        ];

        localStorage.chat = JSON.stringify(array_chat);

    }
    else{

        array_chat = JSON.parse(localStorage.chat);

        const new_msg_obj = {"role":"user","content":user_message};

        array_chat[array_chat.length] = new_msg_obj;

        localStorage.chat = JSON.stringify(array_chat);
        
    }

    sendMessageToChatbot(array_chat);

}

const setBotFirstMessage = () => {

    const firstBotMessage = "Hola, soy un asistente virtual. ¿Cuál es tu nombre?";
    
    jQuery('.chatbot_ai_body_message_wrap').append(`
        <div class="chatbot">
            <p>
                <span class="title">Chatbot:</span><br>
                <span class="msg">${firstBotMessage}</span>
            </p>
        </div>`
    );

};

const handleBotInput = (bot_message) => {
        
    const lastchild = jQuery('.chatbot_ai_body_message_wrap').children().last();
    
    if (bot_message.length > 0) {

        setTimeout(function() {

            jQuery('.chatbot_ai_body_message_wrap').append(`

                <div class="chatbot">
                    
                    <p>
                        ${ ! lastchild.hasClass('chatbot') ? '<span class="title">Chatbot:</span><br>' : ''}
                        <span class="msg">${bot_message}</span>
                    </p>
                </div>`
            );            

        },300);

    }

}

const handleUserInput = () => {
    
    const chatbot_ai_input = jQuery('.chatbot_ai_input');
    const user_message = chatbot_ai_input.val().trim(); chatbot_ai_input.val("");
    //console.log(user_message);
    
    const lastchild = jQuery('.chatbot_ai_body_message_wrap').children().last();
    
    if (user_message.length > 0) {

        setTimeout(function() {

            jQuery('.chatbot_ai_body_message_wrap').append(`

                <div class="user">
                    <p>
                        ${ ! lastchild.hasClass('user') ? '<span class="title">Yo:</span><br>' : ''}
                        <span class="msg">${user_message}</span>
                    </p>
                </div>`
            );

            enqueueUserMessages(user_message);

        },300);

    }

}

const resetChatBotAI = () => {

    localStorage.chat = 'null';

    // eliminamos un evento para que al presionar enter se envíe el mensaje
    jQuery(window).off('keydown', handleKeyPress );

    if ( jQuery('.chatbot_ai_btn_start').hasClass('chat_started') ) {

        jQuery('.welcome_message').removeClass('no-show');
        jQuery('.chatbot').toggleClass('no-show');
        //jQuery('.user').toggleClass('no-show');
        
        jQuery('.chatbot_ai_btn_start').removeClass('chat_started');
        jQuery('.chatbot_ai_btn_start span').toggleClass('no-show');
        
        jQuery('.chatbot_ai_header').removeClass('chat_started');
        jQuery('.chatbot_ai_header').removeClass('no-show');    
        
        jQuery('.chatbot_ai_body').removeClass('chat_started');
        
        jQuery('.chatbot_ai_body_input_wrap').removeClass("chat_started");
        
        jQuery('.chatbot_ai_input').removeClass('chat_started');
    
        jQuery('.chatbot_ai_input').attr('placeholder', 'Escribe tu nombre aquí...');
    
        jQuery('.chatbot_ai_body_message_wrap .user').remove();
        jQuery('.chatbot_ai_body_message_wrap .chatbot').remove();    

    };
    
};

const restoreChatMessages = () => {

    if ( 
        localStorage.chat !== 'null' && 
        localStorage.chat !== undefined && 
        localStorage.chat !== "" 
    ){

        // agregamos un evento para que al presionar enter se envíe el mensaje
        jQuery(window).on('keydown', handleKeyPress );

        jQuery('.chatbot_ai_header').addClass('no-show');
        jQuery('.chatbot_ai_body').addClass('chat_started');
        jQuery('.welcome_message').addClass('no-show');

        jQuery('.chatbot_ai_body_input_wrap').addClass('chat_started');
        jQuery('.chatbot_ai_input').addClass('chat_started');
        jQuery('.chatbot_ai_btn_start').addClass('chat_started');
        jQuery('.chatbot_ai_btn_start span').toggleClass('no-show');
        

        const array_chat = JSON.parse(localStorage.chat);

        array_chat.forEach((message) => {
            if ( message.role === 'user' ) {
                jQuery('.chatbot_ai_body_message_wrap').append(`
                    <div class="user">
                        <p>
                            <span class="title">Yo:</span><br>
                            <span class="msg">${message.content}</span>
                        </p>
                    </div>`
                );
            }
            else{
                jQuery('.chatbot_ai_body_message_wrap').append(`
                    <div class="chatbot">
                        <p>
                            <span class="title">Chatbot:</span><br>
                            <span class="msg">${message.content}</span>
                        </p>
                    </div>`
                );
            }
        });

    }
};

const handleKeyPress = (ev) => {
        
    if (ev.keyCode === 13) {
        ev.preventDefault();
        handleUserInput();
    }

}

jQuery(window).on('load', () => {
    
    restoreChatMessages();

    /**
     * * Chatbot AI Button Click Event
     * * This function toggles the visibility of the chatbot AI wrapper and button.
     */
    jQuery('.chatbot_ai_button').on('click', function() {
        
        jQuery('.chatbot_ai_wrapper').toggleClass('expanded');
        jQuery('.chatbot_ai_button').toggleClass('vanish opened');
        jQuery('.chatbot_ai_container').toggleClass('expanded no-show');

        setTimeout(function() {            
            jQuery('.chatbot_ai_button').toggleClass('vanish');
            jQuery('.chatbot_ai_button span').toggleClass('no-show');
            jQuery('.chatbot_ai_anchor_reset_chat').toggleClass('no-show');
            
        }, 300);       

        jQuery('.chatbot_ai_input').removeClass('user_name_error');

    });


     /* animation */
     setInterval(function() {
        jQuery('.chatbot_ai_button > span.message_icon').toggleClass('animated');
    }, 5000);

    /**
     * Este evento inicia el chat
     */
    jQuery('.chatbot_ai_btn_start').on('click', function(ev) {
        console.log('start button clicked');

        const user_name = jQuery('.chatbot_ai_input').val().trim();

        // si el nombre de usuario es menor a 1, entonces se muestra un error
        if ( user_name.length < 1){
            jQuery('.chatbot_ai_input').addClass('user_name_error');
            jQuery('.chatbot_ai_input').focus();
        }
        else{

            jQuery('.chatbot_ai_input').removeClass('user_name_error');

            // si el chart no ha comenzado, entonces se inicia el chat
            if ( ! jQuery('.chatbot_ai_btn_start').hasClass('chat_started')) {
                
                setBotFirstMessage();

                // agregamos un evento para que al presionar enter se envíe el mensaje
                jQuery(window).on('keydown', handleKeyPress );

                jQuery('.chatbot_ai_header').toggleClass('vanish');
                jQuery('.chatbot_ai_btn_start span').toggleClass('vanish no-show');
                jQuery('.chatbot_ai_body_input_wrap').toggleClass('vanish');
        
                jQuery('.chatbot_ai_body').toggleClass('vanish');
                
                setTimeout(function() {
                    
                    jQuery('.welcome_message').toggleClass('no-show');
                    //jQuery('.chatbot').toggleClass('no-show');
                    //jQuery('.user').toggleClass('no-show');
                    
                    jQuery('.chatbot_ai_btn_start').addClass('chat_started');
                    jQuery('.chatbot_ai_btn_start span').toggleClass('vanish');            
                    
        
                    jQuery('.chatbot_ai_body').toggleClass('vanish chat_started');
        
                    // TODO cambiar toggleclass por addclass
                    jQuery('.chatbot_ai_header').toggleClass('vanish no-show');
        
                    jQuery('.chatbot_ai_body_input_wrap').toggleClass('vanish');
                    
                    jQuery('.chatbot_ai_header').toggleClass('chat_started');
                    jQuery('.chatbot_ai_input').toggleClass('chat_started');
                    jQuery('.chatbot_ai_body_input_wrap').toggleClass("chat_started");
                    
                    jQuery('.chatbot_ai_input').attr('placeholder', 'Escribe tu mensaje...');
        
        
                    // TODO cambiar toggleclass por addclass
                }, 300);
            }
            else{
                ev.preventDefault();
            }

        }
        
        handleUserInput();
        

    });

    jQuery('.chatbot_ai_anchor_reset_chat').on('click', resetChatBotAI );
    

});

