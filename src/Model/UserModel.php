<?php

namespace Model;

use Core\Database;

class UserModel {

    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getById($id) {
        $query = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetch();
        return $results;
    }   

    
}

?>