<?php
    /**
     * Este archivo contiene la configuración inicial del plugin ChatBot AI.
     */
    
    // Seguridad: evitar acceso directo
    if (!defined('ABSPATH')) {
        exit;
    }
    
    define('CHATBOT_AI_VERSION', '1.0.0');

    define('CHATBOT_AI_LANG', 'es');

    define('CHATBOT_AI_BASE_PATH', plugin_dir_path(__FILE__));
    
    define('CHATBOT_AI_BASE_URL', plugin_dir_url(__FILE__));
    