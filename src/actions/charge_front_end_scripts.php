<?php

function chatbot_ai_charge_front_end_scripts() {   
    
    // carga Font Awesome para los iconos
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
    // carga el CSS del plugin
    wp_enqueue_style('chatbot-ai-global-style', plugin_dir_url(__FILE__) . '../../assets/css/global.style.css');
    wp_enqueue_style('chatbot-ai-frontend-style', plugin_dir_url(__FILE__) . '../../assets/css/chatbot_ai_style.css');
    // cargar el JS del plugin
    wp_enqueue_script('chatbot-ai-frontend-scripts', plugin_dir_url(__FILE__) . '../../assets/js/chatbot_ai_script.js', array('jquery'), null, true);

}