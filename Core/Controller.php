<?php

namespace Controller;

use Model\UserModel;

class UserController {

    public function  getUserById($id) {
        $userModel = new UserModel();
        $user = $userModel->getById($id);
    }
}

?>