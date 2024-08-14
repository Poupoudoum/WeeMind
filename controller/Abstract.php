<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


abstract class Controller_Abstract {
 
    public abstract function run();
    
    /**
     * @param Renderer[] $renderers
     */
    public function renderPage(array $renderers) {
        $page = new Renderer("page");
        
        foreach ($renderers as $k => $r) {
            $page->addChild($k, $r);
        }
        
        $page->render();
    }
    
}