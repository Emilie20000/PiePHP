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
                $controllerName = ucfirst($route['controller']) . 'Controller';
                $actionName = $route['action'] . 'Action';

                $controller = 'Controller\\' . $controllerName;
        
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
        
                    if (method_exists($controllerInstance, $actionName)) {
                        $controllerInstance->$actionName();
                    } else {
                        echo '404';
                    }
                } else {
                    echo '404';
                }
            } else {
                echo '404';
            }
        }
    }
    

?>