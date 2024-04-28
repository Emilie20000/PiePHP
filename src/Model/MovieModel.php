<?php

namespace Model;

use Core\Entity;

class MovieModel extends Entity {

    private $table = 'movie';
    private $id;
    private $title;
    private $director;
    private $duration;
    private $release_date;
    private $rating;
    private $relation_id;
    private static $relations = [
        'type' => 'has_one',
        'table' => 'distributor'
    ];

    public function __construct($data) {
        parent::__construct($data);
        
    }

    public function __get($attribut) {
        if (property_exists($this, $attribut)) {
            return $this->$attribut;
        }
    }

    public function __set($attribut, $valeur) {
        if (property_exists($this, $attribut)) {
            $this->$attribut = $valeur;
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDirector($director) {
        $this->director = $director;
    }

    public function setDuration($duration) {
        $this->duration = $duration;
    }

    public function setRelease_date($release_date) {
        $this->release_date = $release_date;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function setRelation_id($relation_id) {
        $this->relation_id = $relation_id;
    }

    public function read_allMovies() {

        $movies = $this->orm->read_all($this->table, __CLASS__);
        return $movies;
    }

    public function readMovie() {
        $id = $this->id;
        $model = static::class;
        $movie = $this->orm->read($this->table, static::class, $id);
    
        return $movie;
    }

    public function deleteMovie() {
        $id = $this->id;
        $delete = $this->orm->delete($this->table, $id);
        return $delete;
    }

    public function createMovie() {
        $fields = [
            'id_distributor' => $this->relation_id,
            'title' => $this->title,
            'director' => $this->director,
            'duration' => $this->duration,
            'release_date' => $this->release_date,
            'rating' => $this->rating
        ];

        var_dump($fields);

        $movieId = $this->orm->create($this->table, $fields);

        if ($movieId) {
            $this->setId($movieId);
        }


    }

}


?>