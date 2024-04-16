<?php

namespace Model;

use Core\Database;
use PDO;

class UserModel {

    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getUsers() {
        $query = 'SELECT * FROM users';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }   

    
}

?>