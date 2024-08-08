<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


class Controller_Index extends Controller_Abstract {
    
    public function run() {
        (new Renderer('index'))->render();
    }
    
}