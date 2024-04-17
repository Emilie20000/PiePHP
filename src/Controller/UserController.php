<?php

namespace Controller;

use Core\Controller;
use Model\UserModel;

class UserController extends Controller {

    public function addAction() {
        $this->render('register');
    }

    public function registerAction() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $this->request->post('email');
            $password = $this->request->post('password');

            $userModel = new UserModel($email, $password);

            $register = $userModel->create();

            if ($register) {
                echo 'Inscription réussie';
            } else {
                echo 'Erreur lors de l\'inscription';
            }

        }
    }
    
}

?>