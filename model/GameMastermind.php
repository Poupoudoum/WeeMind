<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


class GameMastermind extends Game {
    
    /**
     * @var GameMastermindProposition[]
     */
    protected $propositions = array();
    
    public function __construct(
            protected $combinationWidth = 4, 
            protected $combinationHeight = 6, 
            protected $maxAtemps = 15, 
            protected $combination = null
            ) {
        parent::__construct();
        if (!$this->combination) {
            $this->generateRandomCombination();
        }
    }
    
    public function getPropositions(): array {
        return $this->propositions;
    }

    public function getCombinationWidth() {
        return $this->combinationWidth;
    }

    public function getCombinationHeight() {
        return $this->combinationHeight;
    }

    public function getMaxAtemps() {
        return $this->maxAtemps;
    }

    public function getCombination() {
        return $this->combination;
    }

    public function getNumberOfPlayers() {
        return 1; 
    }

    public function isGameOver(): bool {
        return $this->getWinner() || count($this->propositions) >= $this->maxAtemps;
    }
    
    public function getWinner(): ?int {
        return end($this->propositions)->getCombination() == $this->combination ? 1 : null;
    }

    public function play(\GameMove $move) {
        if ($this->isGameOver()) {
            throw new Exception("Game is over");
        }
        $this->propositions[] = $move;
    }

    public function addProposition(string $combination) {
        $this->propositions[] = new GameMastermindProposition($this, $combination);
    }

    public function reset() {
        $this->propositions = array();
        $this->generateRandomCombination();
    }
    
    protected function generateRandomCombination() : string {
        $this->combination = "";
        for ($i = 0; $i < $this->combinationWidth; $i++) {
            $this->combination .= random_int(1, $this->combinationHeight);
        }
        return $this->combination;
    }

    public static function createFromSaveArray(array $saveArray): \Loadable {
        //one set by property
        $instance = new self();
        
        if (isset($saveArray['combinationWidth'])) { $instance->combinationWidth = $saveArray['combinationWidth']; }
        if (isset($saveArray['combinationHeight'])) { $instance->combinationHeight = $saveArray['combinationHeight']; }
        if (isset($saveArray['maxAtemps'])) { $instance->maxAtemps = $saveArray['maxAtemps']; }
        if (isset($saveArray['combination'])) { $instance->combination = $saveArray['combination']; }
        if (isset($saveArray['propositions'])) { 
            foreach ($saveArray['propositions'] as $proposition) {
                $instance->addProposition($proposition);
            }
        }

        return $instance;
    }
    
    public function toSaveArray(): array {

        $propositions = array();
        foreach ($this->propositions as $proposition) {
            $propositions[] = $proposition->getCombination();
        }

        return [
            //one element by property
            'propositions' => $propositions,
            'combinationWidth' => $this->combinationWidth,
            'combinationHeight' => $this->combinationHeight,
            'maxAtemps' => $this->maxAtemps,
            'combination' => $this->combination
        ];
    }

}
