<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */



abstract class GameMove {
    public function __construct(protected Game $game) {}
}