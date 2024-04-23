<?php

namespace Model;

class ArticleModel extends Entity {

    private $orm;
    private static $relation = [
        'has_many' => 'tags'
    ];

    public function __construct($data) {
        parent::__construct($data);
        $this->orm = new ORM;
        
    }

   public function getTags() {

   }
     

    

}


?>