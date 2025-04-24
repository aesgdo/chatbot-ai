<?php 

/*
Plugin Name: ChatBot AI
Plugin URI: https://github.com/aesgdo/chatbot-ia
Description: Agent AI created to assist in the in FAQs and support of the site. It is a simple chatbot that uses the OpenAI API to answer questions. 
Version: 1.0.0
Requires at least: 6.8
Requires PHP: 8.2.12
Author: aesg_do
Author URI: https://x.com/aesg_do
License: MIT or later
Text Domain: akismet
*/


// Seguridad: evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// incluimos el archivo de configuración
include(plugin_dir_path(__FILE__).'admin/settings.php');

// incluimos el archivo de que invoca las funciones actions y filters
include(plugin_dir_path(__FILE__).'functions.php');

// Hook para cargar scripts y estilos
add_action('admin_enqueue_scripts', 'chatbot_ai_charge_admin_scripts');

// Hook para agregar el enlace de "Ajustes" al lado de "Desactivar"
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'chatbot_ai_add_link_settings');

// agrega el menu de configuracion al back-end de wordpress
add_action('admin_menu','chatbot_ai_menu'); 