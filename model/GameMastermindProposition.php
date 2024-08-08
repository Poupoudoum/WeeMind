<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


/**
 * @property GameMastermind $game
 */
class GameMastermindProposition extends GameMove {
    
    public function __construct(GameMastermind $game, protected string $combination) {
        parent::__construct($game);
    }
    
    public function getCombination() {
        return $this->combination;
    }
    
    public function getValidCount() : int {
        $exactCount = 0;

        for ($i = 0; $i < $this->game->getCombinationWidth(); $i++) {
            if ($this->combination[$i] == $this->game->getCombination()[$i]) {
                $exactCount++;
            }
        }

        return $exactCount;
    }
    
    public function getApproxCount() : int {
        $approxCount = 0;

        // here our reference is gamecombination and we search for a match in the proposal, 
        // this enables having multiple matches event if the player has only entered 1 good proposal
        //  example SECRET = 2213 and proposal = 4321, we have 2 matches for 2
        for ($i = 0; $i < $this->game->getCombinationWidth(); $i++) {
            if ($this->combination[$i] != $this->game->getCombination()[$i] && strpos($this->combination, $this->game->getCombination()[$i]) !== false) {
                $approxCount++;
            }
        }

        return $approxCount;
    }
}
