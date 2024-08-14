<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


class PersisterSession extends Persister {
    
    public static function load(Loadable &$l, $index) {
        return $l = is_array($_SESSION[$index] ?? false) ? $l::createFromSaveArray($_SESSION[$index]) : $l;
    }

    public static function save(Saveable $s, $index) {
        $_SESSION[$index] = $s->toSaveArray();
    }
    
}