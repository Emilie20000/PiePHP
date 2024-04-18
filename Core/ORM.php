<?php

namespace Core;

use Core\Database;
use PDO;

class ORM {

    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
        var_dump($this->db);
    }

    public function create($table, $fields) {
        $keys = implode(', ', array_keys($fields));
        $values = ':' . implode(', :', array_keys($fields));
    
        $query = "INSERT INTO $table ($keys) VALUES ($values)";
        $stmt = $this->db->prepare($query);
    
        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    
        return $stmt->execute();
    }
    

    public function read($table, $id) {
        $query = "SELECT * FROM $table WHERE id = ?";
        $stmt = $this->bindParam(1, $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $id, $fields) {
        $setFields = [];
        $params = [];

        foreach ($fields as $key => $value) {
            $setFields[] = "$key = ?";
            $params[] = $value;
        }

        $params[] = $id;

        $setFields = implode(', ', $setFields);
        $query = "UPDATE $table SET $setFields WHERE id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        return $stmt->rowCount() > 0;
    }

    public function delete($table, $id) {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = $this->db->prepare($query);

        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public function read_all($table) {
        $query = "SELECT * FROM $table";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }
}

?>