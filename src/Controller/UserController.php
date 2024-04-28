<?php

namespace Controller;

use Core\Controller;
use Core\SecurityUtils;
use Model\UserModel;


class UserController extends Controller {

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
            var_dump($params);
            $user = new UserModel($params);
            $user->findByEmail();

            var_dump($user->id);

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
       
        $user = new UserModel(['id' => $id]);
        $user->id = $id;
        $data = $user->readUser();

        $this->render('index', ['user' => $data]);
    }
    
    public function showAction($id) {
       
        $user = new UserModel(['id' => $id]);;
        $user->id = $id;
        $data = $user->readUser();

        $this->render('show', ['user' => $data]);
    }

    public function updateAction($id) {
        $this->render('update');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $params = $this->request->getQueryParams();
            $params['id'] = $id;
            $user = new UserModel($params);
            var_dump($params);
            if (!empty($params['email'])) {
              
                    $update = $user->updateUser();
                    $this->redirect('/user/show/' . $id);
                
            } else {
                $update = $user->updateUser();
                $this->redirect('/user/show/' . $id);
            }
            
        }
    }

    public function deleteAction($id) {
        $user = new UserModel(['id' => $id]);;
        $user->id = $id;
        $delete = $user->deleteUser();
        if ($delete) {
            $this->redirect('/');
        }
    }

    public function logoutAction($id) {
        session_unset();
        session_destroy();
        
        $this->redirect('/');
        
    }
}

?>