<?php

namespace Core;

use Core\Request;
use Core\TemplateEngine;

class Controller {

   protected static $_render;
   protected $request;

   public function __construct() {
    $this->request = new Request();
    $this->templateEngine = new TemplateEngine();
   }

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

    protected function createSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    protected function redirect($url) {
        header('Location: ' . BASE_URI . $url);
    }

    protected function paginator($currentPage, $perPage, $totalItems) {
        
        $totalPages = ceil($totalItems / $perPage);
    
        $pagination = [
            'current_page' => $currentPage,
            'total_pages' => $totalPages,
            'next_page' => ($currentPage < $totalPages) 
                                ? $currentPage + 1 : null,
            'prev_page' => ($currentPage > 1) 
                                ? $currentPage - 1 : null,
        ];
    
        return $pagination;
    }

}



?>