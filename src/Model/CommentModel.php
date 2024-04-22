<?php

namespace Model;

class CommentModel {

    private static $relation = [
        'has_one' => 'article'
    ];
}

?>