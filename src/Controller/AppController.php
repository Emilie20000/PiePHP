<?php

namespace Controller;

use Core\Controller;

class AppController extends Controller {

    public function indexAction() {
        echo 'Bienvenue dans PiePHP';
        echo '<a href="' . BASE_URI . '/register">S\'inscrire</a>';
        echo '<a href="' . BASE_URI . '/login">Se connecter</a>';
    }
}

?>