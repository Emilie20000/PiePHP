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
    
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
    }
    

    public function read($table, $model, $id) {
       
        $query = "SELECT * FROM $table WHERE id = :id";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $relation = $this->getRelation($table, $model, $id); 
    
            if ($relation) {
                
                $data = [];
                $data['main'] = $result;
                $data['relation'] = $relation;
                return $data;
                
            }  else {
                return $result;
            }

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

    public function getRelation($table, $model, $id) {
    
        if (class_exists($model)) {

            $reflectionClass = new \ReflectionClass($model);
    
            if ($reflectionClass->hasProperty('relations')) {
    
                $relations = $reflectionClass->getStaticPropertyValue('relations');
              
                if (isset($relations['type']) && isset($relations['table'])) {
    
                        switch ($relations['type']) {
                            case 'has_one':
                                return $this->hasOne($table, $relations['table'], $id);
                            case 'has_many':
                                return $this->hasMany($table, $relations['table'], $id);
                        }
                    }
                 }
        } else {

            return;
        }
    
    }

    private function hasOne($table1, $table2, $id) {
        $query = "SELECT  $table2.*
                    FROM $table2
                    INNER JOIN $table1 
                    ON {$table2}.id = {$table1}.id_{$table2}
                    WHERE {$table1}.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    private function hasMany($table1, $table2, $id) {
        $query = "SELECT {$table2}.*
            FROM {$table1}
            INNER JOIN {$table2} 
            ON {$table1}.id = {$table2}.id_{$table1}
            WHERE {$table1}.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
        
    }
}

?>