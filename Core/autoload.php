<?php

spl_autoload_register(function($className) {
   
    $namespaces = [
        'Core\\' => 'Core/',
        'Controller\\' => 'src/Controller/',
        'Model\\' => 'src/Model/'
    ];

    foreach ($namespaces as $namespace => $directory) {
       
        if (strpos($className, $namespace) === 0) {

            $classPath = __DIR__ . '/../' . $directory . 
                        str_replace('\\', '/', substr($className, 
                        strlen($namespace))) . '.php';
            
         
            if (file_exists($classPath)) {
        
                require_once $classPath;
                return;
            }
        }
    }
});



?>