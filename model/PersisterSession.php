<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


class PersisterSession extends Persister {
    
    public function load(Loadable $l, $index) {
        return is_array($_SESSION[$index]) ? $l::createFromSaveArray($_SESSION[$index]) : $l;
    }

    public function save(Saveable $s, $index) {
        $_SESSION[$index] = $s->toSaveArray();
    }
    
}