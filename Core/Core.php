<?php

/* Définition d'une classe 'Core' dans le namespace 'Core'
    La méthode run affiche le nom de la classe actuelle + message [OK] + saut à la ligne
     */

namespace Core;

class Core {
    
    public function run() {

        echo __CLASS__ . " [OK] " . PHP_EOL;
    }
}

?>