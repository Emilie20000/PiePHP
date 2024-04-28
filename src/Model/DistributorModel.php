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

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function readDistributor() {
        $id = $this->id;
        $distributor = $this->orm->read($this->table, static::class, $id);
    
        return $distributor;
    }

    public function read_allDistributors() {

        $distributor = $this->orm->read_all($this->table, static::class);
        return $distributor;
    }

    public function createDistributor() {
        $fields = [
            'name' => $this->name,
            'country' => $this->country
        ];

    
        $distributorId = $this->orm->create($this->table, $fields);

        if ($distributorId) {
            $this->setId($distributorId);
        }

    }
}

?>