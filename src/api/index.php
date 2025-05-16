<?php
    
    // cargar el entorno de WordPress
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    // cargar el entorno del plugin
    include_once( '../../admin/settings.php');
    include_once( '../../functions.php');
    include_once( './api.php');