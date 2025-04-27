<?php

function chatbot_ai_charge_front_end_scripts() {   
    
    wp_enqueue_style('chatbot-ai-global-style', plugin_dir_url(__FILE__) . '../../assets/css/global.style.css');
    wp_enqueue_style('chatbot-ai-frontend-style', plugin_dir_url(__FILE__) . '../../assets/css/chatbot_ai_style.css');
    wp_enqueue_script('chatbot-ai-frontend-scripts', plugin_dir_url(__FILE__) . '../../assets/js/chatbot_ai_script.js', array('jquery'), null, true);

}