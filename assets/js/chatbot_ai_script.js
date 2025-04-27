
jQuery(window).on('load', () => {
    
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
        }, 300);       

    });


     /* animation */
     setInterval(function() {
        jQuery('.chatbot_ai_button > span.message_icon').toggleClass('animated');
    }, 5000);


    jQuery('.chatbot_ai_btn_start').on('click', function() {
        console.log('start button clicked');

        jQuery('.chatbot_ai_header').toggleClass('vanish');

        jQuery('.chatbot_ai_btn_start span').toggleClass('vanish no-show');

        jQuery('.chatbot_ai_body_input_wrap').toggleClass('vanish');

        jQuery('.chatbot_ai_body').toggleClass('vanish');
        
        setTimeout(function() {

            
            jQuery('.welcome_message').toggleClass('no-show');
            jQuery('.chatbot').toggleClass('no-show');
            jQuery('.user').toggleClass('no-show');

            jQuery('.chatbot_ai_body').toggleClass('vanish chat_started');

            // TODO cambiar toggleclass por addclass
            jQuery('.chatbot_ai_header').toggleClass('vanish no-show');

            jQuery('.chatbot_ai_btn_start span').toggleClass('vanish');
            jQuery('.chatbot_ai_body_input_wrap').toggleClass('vanish');
            
            jQuery('.chatbot_ai_header').toggleClass('chat_started');
            jQuery('.chatbot_ai_btn_start').toggleClass('chat_started');
            jQuery('.chatbot_ai_input').toggleClass('chat_started');
            jQuery('.chatbot_ai_body_input_wrap').toggleClass("chat_started");
            
            jQuery('.chatbot_ai_input').attr('placeholder', 'Escribe tu mensaje...');


            // TODO cambiar toggleclass por addclass
        }, 300);
    });


});