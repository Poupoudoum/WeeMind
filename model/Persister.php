<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */


abstract class Persister {
    public abstract function save(Saveable $s, $index);
    public abstract function load(Loadable $l, $index);
}