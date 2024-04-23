<?php

namespace Core;

use Core\Database;
use PDO;

class ORM {

    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
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

    public function find($table, $params = []) {
        $query = "SELECT * FROM $table";

    if (!empty($params['WHERE'])) {
        $query .= " WHERE " . $params['WHERE'];
    }

    if (!empty($params['ORDER BY'])) {
        $query .= " ORDER BY " . $params['ORDER BY'];
    }


    if (!empty($params['LIMIT'])) {
        $query .= " LIMIT " . $params['LIMIT'];
    }

    $stmt = $this->db->prepare($query);

    if (isset($params['params'])) {
        foreach ($params['params'] as $key => $value) {
            $stmt->bindValue($key, $value);
        }
    }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($params['relations']) && is_array($params['relations'])) {
            foreach ($params['relations'] as $relation => $model) {
                $result[$relation] = $this->getRelation($model, 
                                                          $result['id'], 
                                                          $relation);
            }
        }
    
        return $result;
    }

    public function getRelation($model, $id, $relation) {
        switch ($relation) {
            case 'has_one':
                return $this->hasOne($model, $id);
            case 'has_many':
                return $this->hasMany($model, $id);
        }
    }

    private function hasOne($model, $id) {
        $query = "SELECT * FROM $model WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function hasMany($model, $id) {
        $query = "SELECT * FROM $model WHERE {$model}_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>