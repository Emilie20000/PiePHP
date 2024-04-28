<?php

namespace Controller;

use Core\Controller;
use Model\DistributorModel;

class DistributorController extends Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function indexAction() {

        $distributor = new MovieModel([]);
        $distributor = $movie->read_allMovies();

        $currentPage = 1;
        $perPage = 50;
        $pagination = $this->paginator($currentPage, $perPage, count($distributor));
     
        $this->render('index', ['distributor' => $distributor, 
                                'pagination' => $pagination]);

    }

    public function showAction($id) {
        $distributor = new DistributorModel(['id' => $id]);;
        $distributor->id = $id;
        $data = $distributor->readDistributor();
     
        $this->render('show', ['distributor' => $data]);
    }

    public function deleteAction($id) {

    }

}

?>