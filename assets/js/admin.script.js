console.log("Chatbot IA admin script loaded");

const updateChatbotAIModel = async (ai_model) => {

    try {
        
        const url = './../wp-content/plugins/chatbot-ai/src/api/index.php';
    
        const data = {
            model   : ai_model,
            target : 'openai-update_model',
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
            
        // enviar mensaje al usuario
        //enqueueChatBotMessages(response.message.lang_es);    

    } catch (error) {
        
        console.error('Error:', error);
        // enviar mensaje al usuario
        //enqueueChatBotMessages("Lo siento, no puedo ayudarte en este momento. Por favor, inténtalo más tarde.");
    }

};


const updateChatbotAIApiKey = async (api_key) => {

    try {
        
        const url = './../wp-content/plugins/chatbot-ai/src/api/index.php';
    
        const data = {
            apikey : api_key,
            target : 'openai-update_apikey',
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
            
        // enviar mensaje al usuario
        //enqueueChatBotMessages(response.message.lang_es);    

    } catch (error) {
        
        console.error('Error:', error);
        // enviar mensaje al usuario
        //enqueueChatBotMessages("Lo siento, no puedo ayudarte en este momento. Por favor, inténtalo más tarde.");
    }

};

const handleClickApikeyModel = (apikey = '') => {


    updateChatbotAIApiKey(apikey);

}

const handleChangeModel = (model = 'o4-mini') => {


    updateChatbotAIModel(model);

}

jQuery(window).on('load', () => {


    jQuery('.chatbot_ai_apikey_button').on('click', (ev) => {
        ev.preventDefault();
        let apikey = jQuery('.chatbot_ai_openai_apikey').val();

        handleClickApikeyModel(apikey);

    });

    // Handle change of 
    jQuery('.chatboit_ai_model_select').on('change', (ev) => {
        ev.preventDefault();
        console.log('Model selected: ', jQuery('.chatboit_ai_model_select').val() );

        let model = jQuery('.chatboit_ai_model_select').val();

        handleChangeModel(model);

    });
        
});