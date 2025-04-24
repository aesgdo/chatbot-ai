<?php

/**
 * Este filtro añade un enlace a la página de configuración del plugin en la lista de plugins instalados.
 * Se utiliza el hook 'plugin_action_links_{plugin_basename}' para añadir el enlace.
 */
function chatbot_ai_add_link_settings($links) {
    $ajustes_url = admin_url('admin.php?page=chatbot-ai-dashboard');
    $nuevo_link = '<a href="' . esc_url($ajustes_url) . '">Settings</a>';
    array_unshift($links, $nuevo_link); // lo ponemos al principio de la lista
    return $links;
}