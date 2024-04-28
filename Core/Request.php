<?php

namespace Core;

class Request {

    public function __construct() {

        $this->params = $this->secureInput($_REQUEST);
    }

    public function getQueryParams() {

        return $this->params;
    }

    private function secureInput($data) {

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->secureInput($value);
            }
        } else {

            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
        }

        return $data;
    }
}

?>