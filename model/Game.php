<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


abstract class Game implements Saveable, Loadable {
    public abstract function reset();
    public abstract function isGameOver() : bool;
    public abstract function getWinner() : ?int; //returns the number of the winning player, null if nobody have won
    public abstract function play(GameMove $move);
    public abstract function getNumberOfPlayers();
}
