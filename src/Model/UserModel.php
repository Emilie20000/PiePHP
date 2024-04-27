<?php

namespace Model;

use Core\Entity;
use Core\ORM;
use Core\SecurityUtils;

class UserModel extends Entity {

    private $table = 'user';
    private $id;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $email;
    private $password;

    public function __construct($data) {
        parent::__construct($data);
        $this->data = $data; 
    }

    public function __get($attribut) {
        if (property_exists($this, $attribut)) {
            return $this->$attribut;
        }
    }

    public function __set($attribut, $valeur) {
        if (property_exists($this, $attribut)) {
            $this->$attribut = $valeur;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function findByEmail() {
        $params = [
            'WHERE' => 'email = :email'
        ];

        $email = $this->email;
        $params['params'] = [':email' => $email];
        $user = $this->orm->find($this->table, $params);

        if ($user) {
            
            $this->setId($user['id']);
            $this->setFirstname($user['firstname']);
            $this->setLastname($user['lastname']);
            $this->setBirthdate($user['birthdate']);
            $this->setEmail($user['email']);
            $this->setPassword($user['password']);
        }
    
        return $user;

    }

    public function createUser() {
        $this->password = SecurityUtils::hashPassword($this->password);
        $fields = [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'password' => $this->password
        ];

        var_dump($fields);

        $userId = $this->orm->create($this->table, $fields);

        if ($userId) {
            $this->setId($userId);
        }

        
    }
    
    public function readUser() {

        $id = $this->id;
        $user = $this->orm->read($this->table, __CLASS__, $id);
    
        return $user;
    }

    public function upadateUser() {

    }

    public function deleteUser() {
        $id = $this->id;
        $delete = $this->orm->delete($this->table, $id);
        return $delete;
    }

    public function read_allUsers() {

    }


    public function findUser() {

        $params = [
            'WHERE' => 'email = :email'
        ];

        $email = $this->email;

        $params['params'] = [':email' => $email];

        return $this->orm->find($this->table, $params);
    }
    
}

?>