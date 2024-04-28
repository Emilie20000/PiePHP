<?php

/* Définition d'une classe 'Core' dans le namespace 'Core'
    La méthode run affiche le nom de la classe actuelle + message [OK] + saut à la ligne
     */
    namespace Core;

    class Core {

        public function run() {

            require_once(__DIR__ . '/../src/routes.php');

            $currentUrl = $_SERVER['REQUEST_URI'];
       
            $route = Router::get($currentUrl) ?? Router::dynamicGet($currentUrl);

            if ($route) {
                Router::dispatch($route);
            } else {
                echo '404';
            }
        }
    }
    

?>