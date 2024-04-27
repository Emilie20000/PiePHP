<?php

namespace Controller;

use Core\Controller;
use Core\SecurityUtils;
use Model\UserModel;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class UserController extends Controller {

    protected $userModel;

    public function __construct() {
        parent::__construct();
        
    }

    public function indexAction() {
        $this->render('index');
    }

    public function registerAction() {

        $this->render('register');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $params = $this->request->getQueryParams();


            if (!SecurityUtils::passwordMatch($params['password'], 
                                              $params['confirm_password'])) {
                echo 'Les mots de passe ne correspondent pas';
                return false;
            }

            if (!SecurityUtils::securePassword($params['password'])) {
                echo 'Le mot de passe doit mesurer au moins 8 caratères et contenir : 
                        - des lettre majuscules et minuscule
                        - des chiffres
                        - des caractères spéciaux';
                return false;
            }

            unset($params['confirm_password']);
            $userModel = new UserModel($params);
            $user = $userModel->findByEmail();

            if (!$userModel->id) {
                $userModel->createUser();
                echo 'Inscription réussie';
            } else {
                echo 'Cet email est déjà associé à un compte';
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