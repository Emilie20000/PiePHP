<?php

namespace Model;

use Core\Database;
use PDO;

class UserModel {

    protected $db;
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->db = Database::getConnection();
        $this->email = $email;
        $this->password = $password;
    }

    public function getUsers() {
        $query = 'SELECT * FROM users';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function save() {
        $query = 'INSERT INTO users (email, password)
                 VALUES (:email, :password)';

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        $results = $stmt->execute();
        
        if ($results->rowCount() > 0) {
            return true;
        }

    }
    
    

    
}

?>