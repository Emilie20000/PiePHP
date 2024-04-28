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
        $movie = new MovieModel(['id' => $id]);;
        $movie->id = $id;
        $data = $movie->readMovie();
     
        $this->render('show', ['movie' => $data]);
    }

    public function deleteAction($id) {
        $movie = new MovieModel(['id' => $id]);
        $movie->id = $id;
        $delete = $movie->deleteMovie();
        if ($delete) {
            $this->redirect('/movie');
        }
    }

    public function addAction($id) {
        $this->render('add');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $params = $this->request->getQueryParams();
            $params['relation_id'] = $id;
            $movie = new MovieModel($params);
            var_dump($params);
            $movie->createMovie();

            if ($movie->id) {
                $this->redirect('/movie/show/' . $movie->id);
            }
        }

      
    }

}

?>