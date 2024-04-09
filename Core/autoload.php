<?php

spl_autoload_register(function($className) {
    
    $classPath = __DIR__ . '/' . 
                str_replace('\\', '/', 
                ltrim(strstr($className, '\\'), '\\')) . '.php';

    var_dump($classPath);
    
    if (file_exists($classPath)) {
        
        require_once $classPath;
    }
});


?>