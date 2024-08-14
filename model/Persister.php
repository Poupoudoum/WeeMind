<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


abstract class Persister {
    public abstract static function save(Saveable $s, $index);
    public abstract static function load(Loadable &$l, $index);
}