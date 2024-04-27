<?php

namespace Model;

use Core\Entity;
use Core\ORM;
use Core\SecurityUtils;

class UserModel extends Entity {

    private $table = 'user';
    private $id;
    protected $firstname;
    protected $lastname;
    protected $birthdate;
    protected $email;
    protected $password;

    public function __construct($data) {
        parent::__construct($data);
        
    }

    public function __get($attribut) {
        if ($attribut === 'id') {
            return $this->getId();
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

        return $this->orm->create($this->table, $fields);
    }
    
    public function readUser() {

    }

    public function upadateUser() {

    }

    public function deleteUser() {

    }

    public function read_allUsers() {

    }

    public function desactiveUser() {

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