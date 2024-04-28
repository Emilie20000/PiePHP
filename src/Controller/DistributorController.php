<?php

namespace Controller;

use Core\Controller;
use Model\DistributorModel;


class DistributorController extends Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function indexAction() {

        $distributor = new DistributorModel([]);
        $distributors = $distributor->read_allDistributors();
    
        $currentPage = 1;
        $perPage = 50;
        $pagination = $this->paginator($currentPage, $perPage, count($distributors));
     
        $this->render('index', ['distributors' => $distributors, 
                                'pagination' => $pagination]);

    }

    public function showAction($id) {
        $distributor = new DistributorModel(['id' => $id]);;
        $distributor->id = $id;
        $data = $distributor->readDistributor();
     
        $this->render('show', ['distributor' => $data]);
    }

    public function addAction($id) {
        $this->render('add');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $params = $this->request->getQueryParams();
           
            $distributor = new DistributorModel($params);
            var_dump($params);
            $distributor->createDistributor();

            if ($distributor->id) {
                $this->redirect('/distributor/show/' . $distributor->id);
            }
        }

      
    }



}

?>