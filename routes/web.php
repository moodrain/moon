<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(['middleware' => 'common'], function() use ($router) {

    $router->get('login', function() { return view('user.login'); });
    $router->get('register', function() { return view('user.register'); });
    $router->post('login', 'UserController@login');
    $router->post('register', 'UserController@register');


    $router->group([
        'middleware' => 'auth'
    ], function() use ($router) {
        $router->get('/', 'IndexController@index');
        $router->post('logout', 'UserController@logout');
    });

});