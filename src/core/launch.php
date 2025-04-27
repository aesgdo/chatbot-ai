<?php

    // Seguridad: evitar acceso directo
    if (!defined('ABSPATH')) {
        exit;
    }   

    // aqui la logica antes de cargar el HTML
    
    include_once(plugin_dir_path(__FILE__) . '../../src/views/chatbot_ai_frontend.view.php');