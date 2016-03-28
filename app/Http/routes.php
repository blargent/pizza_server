<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();


    Route::get('/', function () {
        return view('welcome');
    });

    Route::group(['middleware' => 'auth'], function() {
        // List pizzas
        Route::get('pizzas{id}', 'PizzasController@index');
        // Create  a pizza
        Route::post('pizzas', 'PizzasController@create');


        // List toppings
        Route::get('toppings/{id}', 'ToppingsController@index');
        // Create a topping
        Route::post('toppings', 'ToppingsController@create');
    });

});



