
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

});