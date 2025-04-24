<?php

/**
 * Este archivo contiene la carga de los archivos de funciones del plugin.
 * Se carga en el archivo principal del plugin.
 */

 /**
  * Esta funcion incluye los archivos de funciones que se encuentran en el directorio src/actions y src/filters
  */
function include_files($files){

    if (isset($files) && is_array($files)) {
        for ($i=0; $i < count($files); $i++) { 
            include($files[$i]);
        }        
    }
    return;
}

// array con el nombre de los path a cargar
$array_path = ['actions', 'filters'];

foreach ($array_path as $path) {    
    // glob devuelve un array con los nombres de los archivos que cumplen con el patron
    // ex. $patron = plugin_dir_path(__FILE__).'/actions/*.php'; // Patron de busqueda
    $files = glob( plugin_dir_path(__FILE__).'/src/'.$path.'/*.php' );
    include_files($files);
}