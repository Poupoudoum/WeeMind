<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */
session_start();
define("BP", __DIR__);

//autoloader
spl_autoload_register(function($class) {
    $fileParts = explode('_', $class);
    if (count($fileParts) == 1) {
        if ($fileParts[0] == "Renderer") {
            array_unshift($fileParts, "view");
        } else {
            array_unshift($fileParts, "model");
        }
    }
    $fileParts[0] = strtolower($fileParts[0]);
    $fileParts[1] = ucfirst($fileParts[1]);

    include_once BP."/".implode("/", $fileParts).".php";
});
    
try {
    
    //controller is passed as $c param, @todo add urlrewrite
    $controllerName = $_GET['c'] ?? $_SERVER['PATH_INFO'] ?? 'index';
    $controllerClass = "Controller_".ucfirst(str_replace("/", "", $controllerName));
    $controller = new $controllerClass();

    $controller->run();
        
} catch(Throwable $e) {
    echo "Erreur dans ".basename($e->getFile()).":{$e->getLine()} ".get_class($e)." : ".$e->getMessage();
}