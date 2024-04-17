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
    }
}

?>

