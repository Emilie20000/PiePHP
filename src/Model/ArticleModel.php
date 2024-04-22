<?php

namespace Model;

class ArticleModel extends Entity {

    private static $relations = [
        'has_many' => 'comments'
    ];

   
     

    

}


?>