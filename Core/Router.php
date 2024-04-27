<?php

namespace Core;

class Router {

    private static $routes;

    public static function connect($url, $route) {
        self::$routes[$url] = $route;
    }

    public static function get($url) {

        if (array_key_exists($url, self::$routes)) {
            $route = self::$routes[$url];

            return $route;
        }

        foreach (self::$routes as $routeUrl => $routeParams) {
        
            $routePattern = preg_replace('/\//', '\/', $routeUrl);
            $routePattern = preg_replace('/\{id\}/', '([0-9]+)', $routePattern);
            $routePattern = '/^' . $routePattern . '$/';

            if (preg_match($routePattern, $url, $matches)) {
                $routeParams['params']['id'] = $matches[1];
                return $routeParams;
            }

        }
    }

    public static function dynamicGet($url) {
        $urlParts = explode('/', $url);

        $piePHPIndex = array_search('PiePHP', $urlParts);

        $controllerName = !empty($urlParts[$piePHPIndex + 1])  
            ? ($urlParts[$piePHPIndex + 1])
            : 'app';

        $actionName = !empty($urlParts[$piePHPIndex + 2])
        ? ($urlParts[$piePHPIndex + 2])
        : 'index';
    
        return ['controller' => $controllerName, 'action' => $actionName];
    }

    public static function dispatch($route) {
        $controllerName = ucfirst($route['controller']) . 'Controller';
        $actionName = $route['action'] . 'Action';

        $controller = 'Controller\\' . $controllerName;

        if (class_exists($controller)) {
            $controllerInstance = new $controller();

            if (method_exists($controllerInstance, $actionName)) {
                $reflectionMethod = new \ReflectionMethod(
                    $controllerInstance,
                    $actionName
                );

                $parameters = $reflectionMethod->getParameters();
                if (count($parameters) > 0) {
                    $controllerInstance->$actionName($route['params']['id']);
                } else {
                    $controllerInstance->$actionName();
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

