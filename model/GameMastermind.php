<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


class GameMastermind extends Game {
    
    CONST DEFAULT_WIDTH = 4;
    CONST DEFAULT_HEIGHT = 6;
    CONST DEFAULT_ATEMPTS = 15;
    
    /**
     * @var GameMastermindProposition[]
     */
    protected $propositions = array();
    
    public function __construct(
            protected ?int $combinationWidth = null, 
            protected ?int $combinationHeight = null, 
            protected ?int $maxAtemps = null, 
            protected $combination = null
            ) {
        
        if (!is_numeric($this->combinationWidth) || $this->combinationWidth < 1) {
            $this->combinationWidth = static::DEFAULT_WIDTH;
        }
        if (!is_numeric($this->combinationHeight) || $this->combinationHeight < 2) {
            $this->combinationHeight = static::DEFAULT_HEIGHT;
        }
        if (!is_numeric($this->maxAtemps) || $this->combinationHeight < 2) {
            $this->maxAtemps = static::DEFAULT_ATEMPTS;
        }
        
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
        return (count($this->propositions) && end($this->propositions)->getCombination() == $this->combination) ? 1 : null;
    }

    public function getValidPropositionRegex() {
        return "/^[1-{$this->getCombinationHeight()}]{{$this->getCombinationWidth()}}$/";
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
