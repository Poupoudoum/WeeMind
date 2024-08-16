<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */



abstract class GameMove {
    protected $game;
    
    public function __construct(Game $game) {
        $this->game = $game;
    }
}