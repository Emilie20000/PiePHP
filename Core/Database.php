<?php

namespace Core;

class Database {

    private static $connection;

    public static function getConnection() {

        if (!self::$connection) {

            $host = getenv('DB_HOST');
            $username = getenv('DB_USERNAME');
            $password = getenv('DB_PASSWORD');
            $database = getenv('DB_DATABASE');

            $dsn = 'mysql:host=' . $host . 'dbname=' . $database;

            try {
                self::$connection = new PDO($dsn, $username, $password);
                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $e) {
                throw new Exception(
                    'Erreur de connexion à la base de données : ' . 
                    $e->getMessage());
            }
        }
    }
}

?>