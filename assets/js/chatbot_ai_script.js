
jQuery(window).on('load', () => {
    
    jQuery('.chatbot_ai_button').on('click', function() {
        
        jQuery('.chatbot_ai_wrapper').toggleClass('expanded');
        jQuery('.chatbot_ai_button').toggleClass('vanish opened');
        jQuery('.chatbot_ai_container').toggleClass('expaned no-show');

        setTimeout(function() {
            jQuery('.chatbot_ai_button').toggleClass('vanish');
            jQuery('.chatbot_ai_button span').toggleClass('no-show');
        }, 300);
        
    });




});