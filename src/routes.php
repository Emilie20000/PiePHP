<?php

use Core\Router;

$router = new Router();

$router->addRoute(BASE_URI . '/', 'UserController@index');

return $router;

?>