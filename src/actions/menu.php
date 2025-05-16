<?php

    /**
     * Este archivo contiene la carga de los archivos de funciones del plugin.
     * Se carga en el archivo principal del plugin.
     */
    function chatbot_ai_menu() {
        add_menu_page(
            'Chatbot IA',                   // Título de la página
            'Chatbot IA',                   // Título del menú 
            'manage_options',               // Capacidad necesaria para verlo
            'chatbot-ai-dashboard',         // Slug del menú
            'chatbot_ai_dashboard',         // Función que renderiza la página
            'dashicons-format-chat',        // Icono del menú (puedes cambiarlo por otro de Dashicons)
            6                               // Posición en el menú (opcional)   
        );
        add_submenu_page(
            'chatbot-ai-dashboard',         // Slug del menú padre
            'APIs',                         // Título de la página
            'APIs',                         // Título del menú hijo
            'manage_options',               // Capacidad necesaria para verlo
            'chatbot-ai-api-settings',      // Slug del menú hijo
            'chatbot_ai_apis',              // Función que renderiza la página del menú hijo
        );
        add_submenu_page(
            'chatbot-ai-dashboard',         // Slug del menú padre
            'Agent Training',               // Título de la página
            'Agent Training',               // Título del menú hijo
            'manage_options',               // Capacidad necesaria para verlo
            'chatbot-ai-agent-training',    // Slug del menú hijo
            'chatbot_ai_agent_training',    // Función que renderiza la página del menú hijo
        );
        /* add_submenu_page(
            'chatbot-ai-dashboard',         // Slug del menú padre
            'Chat History',                 // Título de la página
            'Chat History',                 // Título del menú hijo
            'manage_options',               // Capacidad necesaria para verlo
            'chatbot-ai-chat-history',      // Slug del menú hijo
            'chatbot_ai_chat_history',      // Función que renderiza la página del menú hijo
        ); */
    }
