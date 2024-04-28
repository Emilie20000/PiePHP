<?php

use Core\Router;

Router::connect(BASE_URI . '/', ['controller' => 'app',
                                 'action' => 'index']);

Router::connect(BASE_URI . '/register', ['controller' => 'user',
                                         'action' => 'register']);

Router::connect(BASE_URI . '/login', ['controller' => 'user',
                                         'action' => 'login']);

Router::connect(BASE_URI . '/user/{id}', ['controller' => 'user', 
                                      'action' => 'index']);

Router::connect(BASE_URI . '/user/show/{id}', ['controller' => 'user', 
                                      'action' => 'show']);

Router::connect(BASE_URI . '/user/delete/{id}', ['controller' => 'user', 
                                        'action' => 'delete']);

Router::connect(BASE_URI . '/user/update/{id}', ['controller' => 'user', 
                                        'action' => 'update']);


Router::connect(BASE_URI . '/user/logout/{id}', ['controller' => 'user', 
                                        'action' => 'logout']);

Router::connect(BASE_URI . '/movie', ['controller' => 'movie',
                                        'action' => 'index']);

Router::connect(BASE_URI . '/movie/show/{id}', ['controller' => 'movie',
                                        'action' => 'show']);

Router::connect(BASE_URI . '/movie/add/{id}', ['controller' => 'movie',
                                        'action' => 'add']);

Router::connect(BASE_URI . '/movie/delete/{id}', ['controller' => 'movie',
                                        'action' => 'delete']);

Router::connect(BASE_URI . '/distributor', ['controller' => 'distributor',
                                        'action' => 'index']);

Router::connect(BASE_URI . '/distributor/show/{id}', ['controller' => 'distributor',
                                        'action' => 'show']);

Router::connect(BASE_URI . '/distributor/add', ['controller' => 'distributor',
                                        'action' => 'add']);






?>