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
            $user = new UserModel($params);
            $user->findByEmail();

            if (!$user->id) {
                
                $user->createUser();
                session_start();
                $this->createSession('id', $user->id);
                $this->createSession('firstname', $user->firstname);
                $this->createSession('lastname', $user->lastname);
                $this->createSession('birthdate', $user->birthdate);
                $this->createSession('email', $user->email);
                header("Location: " . BASE_URI . "/user/{$user->id}");
                echo 'Inscription réussie';
            } else {
                echo 'Cet email est déjà associé à un compte';
            }

        }
    }

    public function loginAction() {

        $this->render('login');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $params = $this->request->getQueryParams();
            $user = new UserModel($params);
            $user->findByEmail();

            if ($user->id && SecurityUtils::verifyPassword($params['password'], 
                                                        $user->password)) {
               
                $this->createSession('id', $user->id);
                $this->redirect('/user/' . $user->id);
                
            } else {
                echo 'Email ou mot de passe incorrect';
                return false;
            }

        }
    }

    public function indexAction($id) {
       
        $user = new UserModel([]);
        $user->id = $id;
        $data = $user->readUser();

        $this->render('index', ['user' => $data]);
    }
    
    public function showAction($id) {
       
        $user = new UserModel([]);
        $user->id = $id;
        $data = $user->readUser();

        $this->render('show', ['user' => $data]);
    }
}

?>