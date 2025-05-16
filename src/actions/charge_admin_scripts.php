<?php


/**
 * Esta funcion cargar los escript y estilos del plugin
 * Se carga en el archivo principal del plugin.
 */
function chatbot_ai_charge_admin_scripts() {

    // carga el CSS del plugin
    wp_enqueue_style('chatbot-ai-global-style', plugin_dir_url(__FILE__) . '../../assets/css/global.style.css');    
    wp_enqueue_style('chatbot-ai-admin-style', plugin_dir_url(__FILE__) . '../../assets/css/admin.style.css');
    wp_enqueue_script('chatbot-ai-admin-scripts', plugin_dir_url(__FILE__) . '../../assets/js/admin.script.js', array('jquery'), null, true);
}