<?php

namespace Core;

class Entity {

    protected $orm;

    public function __construct(array $data) {

        $this->orm = new ORM();

        if (isset($data['id']) && count($data) === 1) {
            $this->setDataById($data['id']);
        } else {
            $this->setData($data);
        }
    }

    protected function setDataById($id) {
        $data = $this->orm->read($this->table, static::class, $id);
        $this->setData($data);
    }

    protected function setData(array $data) {
        foreach ($data as $key => $value) {
            $setterMethod = 'set' . ucfirst($key);
            if (method_exists($this, $setterMethod)) {
                $this->{$setterMethod}($value);
            }
        }
    }

}

?>