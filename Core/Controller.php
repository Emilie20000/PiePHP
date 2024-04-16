<?php

namespace Controller;

use Model\UserModel;

class Controller {

   protected static $_render;

   protected function render($view, $scope = []) {
    extract($scope);
    $viewFilePath = implode(DIRECTORY_SEPARATOR, [
        dirname(__DIR__), 
        'src', 
        'View', 
        str_replace('Controller', '', basename(get_class($this))), 
        $view
    ]) . '.php';
    
    if (file_exists($viewFilePath)) {
        ob_start();
        include $viewFilePath;
        $viewContent = ob_get_clean();
        
        ob_start();
        include implode(DIRECTORY_SEPARATOR, [
            dirname(__DIR__), 
            'src', 'View', 'index']) . '.php';

        self::$_render = ob_get_clean();
        
        }       
    }
}

?>