<?php

namespace Core;

use PDO;
use Exception;

class Database {

    private static $connection;

    public static function getConnection() {

        if (!self::$connection) {

            define('DB_HOST', 'localhost');
            define('DB_NAME', 'cinema');
            define('DB_USER', 'emilie');
            define('DB_PASSWORD', '1234password');

            try {
                self::$connection = new PDO('mysql:host=' . DB_HOST . 
                                            ';dbname=' . DB_NAME,
                                                         DB_USER,
                                                         DB_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, 
                                                PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception('Erreur de connexion à la bdd : '
                                     . $e->getMessage());
            }
        }

        return self::$connection;
    }
}



?>