<?php

namespace Model;

error_reporting(E_ALL);
ini_set('display_errors', 1);
use Core\Entity;

class MovieModel extends Entity {

    private $table = 'movie';
    private $id;
    private $title;
    private $director;
    private $duration;
    private $release_date;
    private $rating;
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

}


?>