<?php

namespace Core;

class Entity {

    public function __construct(array $data) {

        if (count($data) === 1 && isset($data['id'])) {
            $this->id = $data['id'];
        } else {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }

}

?>