<?php

namespace Core;

class Request {

    public static function get($key, $default = null) {
        return isset($_GET[$key]) ? self::cleanInput($_GET[$key]) : $default;
    }

    public static function post($key, $default = null) {
        return isset($_POST[$key]) ? self::cleanInput($_POST[$key]) : $default;
    }

    private static function cleanInput($value) {
        if (is_array($value)) {
            return array_map('self::cleanInput', $value);
        } else {
            $value = trim($value);
            $value = stripcslashes($value);
            $value = htmlspecialchars($value);

            return $value;
        }
    }

}

?>