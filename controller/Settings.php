<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


class Controller_Settings extends Controller_Play {
    
    public function run() {
        
        if ($_POST && count($_POST)) {
                        
            $this->game = new GameMastermind($_POST['w'] ?? null, $_POST['h'] ?? null, $_POST['a'] ?? null);
            $this->redirectGet();
        }
        
        $this->renderPage([new Renderer("settings", ["mastermind" => $this->game])]);
    }
    
    
}