<?php

    require_once 'app/libs/router.php';

    require_once 'app/controllers/reservations.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';
    $router = new Router();

    $router->addMiddleware(new JWTAuthMiddleware());


    //               endpoint           verbo       controller              metodo
    $router->addRoute('reservations'      ,   'GET',    'reservationsApiController',    'getAll');
    $router->addRoute('reservations/:id'  ,   'GET',    'reservationsApiController',    'get');
    $router->addRoute('reservations'      ,  'POST',    'reservationsApiController',    'create');
    $router->addRoute('reservations/:id'  ,   'PUT',    'reservationsApiController',    'update');
    $router->addRoute('usuarios/token'    ,   'GET',    'userApiController'        ,    'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);