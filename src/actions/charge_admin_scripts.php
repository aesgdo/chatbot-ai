<?php


/**
 * Esta funcion cargar los escript y estilos del plugin
 * Se carga en el archivo principal del plugin.
 */
function chatbot_ai_charge_admin_scripts() {
    wp_enqueue_style('chatbot-ai-style', plugin_dir_url(__FILE__) . '../../assets/css/style.css');
    wp_enqueue_script('chatbot-ai-scripts', plugin_dir_url(__FILE__) . '../../assets/js/script.js', array('jquery'), null, true);
}