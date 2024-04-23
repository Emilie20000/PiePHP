<?php

use Core\Router;

Router::connect(BASE_URI . '/', ['controller' => 'app',
                                 'action' => 'index']);

Router::connect(BASE_URI . '/register', ['controller' => 'user',
                                         'action' => 'addRegister']);

Router::connect(BASE_URI . '/login', ['controller' => 'user',
                                         'action' => 'addLogin']);

Router::connect(BASE_URI . '/users', ['controller' => 'user', 
                                      'action' => 'displayUsers' ]);

?>