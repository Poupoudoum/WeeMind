<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


class Controller_Play extends Controller_Abstract {
    
    const GAME_SESSION_INDEX = "mastermind";
    
    /**
     * @var GameMastermind
     */
    protected $game;
    
    public function __construct() {
        $this->game = new GameMastermind();
        PersisterSession::load($this->game, static::GAME_SESSION_INDEX);
    }
    
    public function run() {
        
        if ($_POST['combination'] ?? false) {
            $this->play($_POST['combination']);
        }
        
        $renderer = new Renderer('mastermind');
        $renderer->setData("mastermind", $this->game);
        
        $this->renderPage([$renderer]);
    }
    
    public function play($combination) {
        
        if ($this->game->isGameOver()) {
            throw new Exception("Le jeu est terminé");
        }
        
        if (is_array($combination)) {
            $combination = join("", $combination);
        }
        
        if (!preg_match($this->game->getValidPropositionRegex(), $combination)) {
            throw new Exception("Proposition invalide !");
        }
        
        $this->game->addProposition($combination);
        
        $this->redirectGet();
    }
    
    public function redirectGet() {
        //save in session
        PersisterSession::save($this->game, static::GAME_SESSION_INDEX);
        //redirect get
        header("Location: /play#proposition");
        exit;
    }
    
    
}