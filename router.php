<?php

    require_once 'app/libs/router.php';

    require_once 'app/controllers/reservations.api.controller.php';

    $router = new Router();

    //               endpoint           verbo       controller              metodo
    $router->addRoute('reservations'      ,   'GET',    'reservationsApiController',    'getAll');
    $router->addRoute('reservations/:id'  ,   'GET',    'reservationsApiController',    'get');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);