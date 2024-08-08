<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */

interface Loadable {
    public static function createFromSaveArray(array $saveArray) : Loadable;
}
