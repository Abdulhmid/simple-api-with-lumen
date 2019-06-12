<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//items routes
$router->get('items', 'ItemsController@index');
$router->get('items/{id}', 'ItemsController@show');
$router->put('items/{id}', 'ItemsController@update');
$router->post('items', 'ItemsController@store');
$router->delete('items/{id}', 'ItemsController@destroy');

//transaction route
$router->post('transaction', 'TransactionController@store');