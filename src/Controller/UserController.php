<?php

namespace Controller;

use Model\UserModel;

class UserController {
    public function index() {
        $userModel = new UserModel();
        $users = $userModel->getusers();
        print_r($users);
    }
}

?>