<?php

namespace Core;

class Router {

    private static $routes;

    public static function connect($url, $route) {
        self::$routes[$url] = $route;
    }

    /*public static function get($url) {

        if (array_key_exists($url, self::$routes)) {
            $route = self::$routes[$url];

            return $route;
        }
    }*/

    public static function get($url) {
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
}   

?>

