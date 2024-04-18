<?php

namespace Model;

use Core\ORM;
use PDO;

class UserModel extends ORM {

    private $table = 'users';
    private $email;
    private $password;

    public function __construct($email, $password) {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
    }

    public function createUser() {
        $fields = [
            'email' => $this->email,
            'password' => $this->password
        ];

        return parent::create($this->table, $fields);
    }
    

    
}

?>