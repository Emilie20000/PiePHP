<?php

namespace Model;

use Core\Entity;
use Core\ORM;

class UserModel extends Entity {

    private $orm;
    private $table = 'users';
    protected $email;
    protected $password;

    public function __construct($data) {
        parent::__construct($data);
        $this->orm = new ORM;
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function createUser() {
        $fields = [
            'email' => $this->email,
            'password' => $this->password
        ];

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