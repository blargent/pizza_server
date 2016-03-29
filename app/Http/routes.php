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
        Route::get('pizzas', 'PizzasController@index');
        // Create  a pizza
        Route::post('pizzas', 'PizzasController@create');

        // List toppings associated with a pizza
        Route::get('pizzas/{id}/toppings', 'PizzasController@showPizzaToppings');

        // Add a topping to a pizza
        Route::post('pizzas/{id}/toppings', 'PizzaController@addToppingToPizza');


        // List toppings
        Route::get('toppings', 'ToppingsController@index');
        // Create a topping
        Route::post('toppings', 'ToppingsController@create');
    });

});



