<?php

namespace Controller;

use Core\Controller;
use Model\UserModel;

class UserController extends Controller {

    protected $userModel;

    public function __construct() {
        parent::__construct();
    }

    public function addRegisterAction() {
        $this->render('register');
    }

    public function addLoginAction() {
        $this->render('login');
    }

    public function registerAction() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $this->request->post('email');
            $password = $this->request->post('password');

            $data = [
                'email' => $email,
                'password' => $password
            ];

            $userModel = new UserModel($data);

            $register = $userModel->createUser($data);


            if ($register) {
                echo 'Inscription réussie';
            } else {
                echo 'Erreur lors de l\'inscription';
            }

        }
    }

    public function loginAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $this->request->post('email');
            $password = $this->request->post('password');

            $data = [
                'email' => $email,
                'password' => $password
            ];

            $userModel = new UserModel($data);

            $user = $userModel->findUser($data);

            if ($user && $data['password'] === $user['password']) {
                echo 'Bienvenue' . $user['email'];
            } else {
                echo 'Erreur lors de la connexion';
            }

        }

    }
    
}

?>