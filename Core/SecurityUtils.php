<?php

namespace Core;

class SecurityUtils {

    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    public static function passwordMatch($password, $confirmPassword) {
        return $password === $confirmPassword;
    }

    public static function securePassword($password) {

        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', $password)) {
            return false;
        }

        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            return false;
        }
        
        if (strlen($password) < 8) {
            return false;
        }

        return true;
    }

}

?>