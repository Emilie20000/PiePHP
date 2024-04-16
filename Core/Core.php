<?php

/* Définition d'une classe 'Core' dans le namespace 'Core'
    La méthode run affiche le nom de la classe actuelle + message [OK] + saut à la ligne
     */

namespace Core;

class Core {

    protected $router;

    public function __construct($router) {
        $this->router = $router;
    }
    
    public function run() {

        echo __CLASS__ . " [OK] " . PHP_EOL;

        $uri = $_SERVER['REQUEST_URI'];

        $this->router->matchUri($uri);
    }
}

?>