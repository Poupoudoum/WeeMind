<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


class Controller_Reset extends Controller_Play {
    
    public function run() {
        $this->game->reset();
        
        $this->redirectGet();
    }
    
    
}