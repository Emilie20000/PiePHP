<?php

namespace Core;

class Router {
    private $routes = [];

    public function addRoute($route, $controllerMethod) {
        $this->routes[$route] = $controllerMethod;
        return $route;
    }

    public function matchUri($uri) {
        if (array_key_exists($uri, $this->routes)) {
            $controllerMethod = $this->routes[$uri];
            $this->callControllerMethod($controllerMethod);

        }else {
            echo 'Route non trouvée';
        }
    }

    private function callControllerMethod($controllerMethod) {
        list($controller, $method) = explode('@', $controllerMethod);
        $controller = 'Controller\\' . $controller;
   
        if (class_exists($controller)) {
            $controllerInstance = new $controller();
            if (method_exists($controllerInstance, $method)) {
                $controllerInstance->$method();
            } else {
                echo 'La méthode ' . $method . ' n\'existe pas';
            }
        } else {
            echo 'Le controller ' . $controller . ' n\'existe pas'; 
        }
    }
}

?>