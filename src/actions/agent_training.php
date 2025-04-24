<?php


    function chatbot_ai_agent_training(){
        // Verifica si el usuario tiene permisos para ver la página
        if (!current_user_can('manage_options')) {
            return;
        }
        
        // Incluye la vista del dashboard
        include(plugin_dir_path(__FILE__) . '../views/agent_training.view.php');
    }