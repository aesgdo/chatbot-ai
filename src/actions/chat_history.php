<?php


    function chatbot_ai_chat_history(){
        // Verifica si el usuario tiene permisos para ver la página
        if (!current_user_can('manage_options')) {
            return;
        }
        
        // Incluye la vista del dashboard
        include(plugin_dir_path(__FILE__) . '../views/chat_history.view.php');
    }