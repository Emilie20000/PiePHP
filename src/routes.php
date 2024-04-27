<?php

use Core\Router;

Router::connect(BASE_URI . '/', ['controller' => 'app',
                                 'action' => 'index']);

Router::connect(BASE_URI . '/register', ['controller' => 'user',
                                         'action' => 'register']);

Router::connect(BASE_URI . '/login', ['controller' => 'user',
                                         'action' => 'login']);

Router::connect(BASE_URI . '/user/{id}', ['controller' => 'user', 
                                      'action' => 'show']);

?>