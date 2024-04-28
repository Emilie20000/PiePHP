<?php

namespace Controller;


use Core\Controller;


class AppController extends Controller {


    public function __construct() {
        parent::__construct();
    }

    public function indexAction() {
        $this->render('index');

    }

    
}

?>