<?php

namespace Controller;

use Core\Controller;
use Model\MovieModel;

class MovieController extends Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function indexAction() {

        $movie = new MovieModel([]);
        $movies = $movie->read_allMovies();
        $currentPage = 1;
        $perPage = 50;
        $pagination = $this->paginator($currentPage, $perPage, count($movies));
        $this->render('index', ['movies' => $movies, 
                                'pagination' => $pagination]);

    }

    public function showAction($id) {

    }

    public function deleteAction($id) {

    }

}

?>