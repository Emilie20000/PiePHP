<?php

namespace Model;

use Core\Entity;

class DistributorModel extends Entity {

    private $table = 'distributor';
    private $id;
    private $name;
    private $phone;
    private $zipcode;
    private $city;
    private $country;
    private static $relations = [
        'type' => 'has_many',
        'table' => 'movie'
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

    public function readDistributor() {
        $id = $this->id;
        $movie = $this->orm->read($this->table, static::class, $id);
    
        return $movie;
    }

}

?>