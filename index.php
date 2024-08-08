<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */

try {
    
    define("BP", __DIR__);
    
    //@todo add autoload
    include '*/*.php';


    //controller is passed as $c param, @todo add urlrewrite
    $controllerName = $_GET['c'] ?? 'index';
    $controllerClass = "Controller_".ucfirst($controller);
    $controller = new $controllerClass();


    $controller->run();
        
        
} catch(Throwable $e) {
    echo "Erreur : ".get_class($e)." : ".$e->getMessage();
}