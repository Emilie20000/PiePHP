<?php

namespace Core;

use Core\Database;
use PDO;

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
    }
    

    public function read($table, $model, $id) {
    
       
        $relation = $this->getRelation($table, $model);
        if ($relation) {
            $query = $relation;
            
        } else {
            $query = "SELECT * FROM $table 
                        WHERE id = :id";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;

        var_dump($result);
    }

    public function update($table, $id, $field, $value) {
        
        $query = "UPDATE $table SET $field = :value WHERE id = :id";
        var_dump($query);
        var_dump($id);
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':value', $value);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function delete($table, $id) {
        $query = "DELETE FROM $table WHERE id = :id";
        var_dump($query);
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function read_all($table, $model) {
        $query = "SELECT * FROM $table";
        $query .= $this->getRelation($table, $model);
        var_dump($query);
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function find($table, $params) {
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

        return $result;
    }

    public function getRelation($table, $model) {
    
        if (class_exists($model)) {

            $reflectionClass = new \ReflectionClass($model);
    
            if ($reflectionClass->hasProperty('relations')) {
    
                $relations = $reflectionClass->getStaticPropertyValue('relations');
    
                if (isset($relations['type']) && isset($relations['table'])) {
    
                        switch ($relations['type']) {
                            case 'has_one':
                                return $this->hasOne($model, $id);
                            case 'has_many':
                                $joinQuery = $this->hasMany($table, $relations['table']);
                                return $joinQuery;
                                var_dump($joinQuery);
                        }
                }
            }
        } else {

            return;
        }
    
    }

    private function hasOne($model, $id) {
        $query = "SELECT * FROM $model WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function hasMany($table, $tables) {

        $numTables = count($tables);
        $join = "";
        $table1 = $table;
        
        for ($i = 0; $i < $numTables; $i++) {
            
            $table2 = $tables[$i];
            
            $query = "SELECT $table1.*, $table2.* FROM $table1
                        INNER JOIN $table2 ON {$table1}.id = {$table2}.{$table1}_id 
                        WHERE {$table1}.id = :id";

            if ($i < $numTables - 1) {
                $table1 = $table2;
            }
        }
        
        return $query;

        
    }
}

?>