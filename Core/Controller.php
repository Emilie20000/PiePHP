<?php

namespace Core;

use Model\UserModel;

class Controller {

   protected static $_render;

   public function __destruct() {
    echo self::$_render;
}

   protected function render($view, $scope = []){
        extract($scope);
        $className = str_replace('Controller', '',
                     basename(str_replace('\\', '/',
                      get_class($this))));

        $f = implode(DIRECTORY_SEPARATOR, 
            [dirname(__DIR__), 'src', 'View', $className, $view])
             . '.php';

        if(file_exists($f)){
            ob_start();
            include($f);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, 
            [dirname(__DIR__), 'src', 'View', 'index'])
             . '.php');

            self::$_render = ob_get_clean();
            
        }
    }
}




?>