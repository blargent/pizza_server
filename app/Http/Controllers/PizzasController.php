<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use GuzzleHttp;

class PizzasController extends Controller
{
    private $client;

    public function __construct() {
        $this->client = new GuzzleHttp\Client(['base_uri' => 'https://pizzaserver.herokuapp.com/']);
    }

    public function index() {
        $request = new GuzzleHttp\Psr7\Request('GET', 'pizzas');

        $promise = $this->client->sendAsync($request)->then(function($response) {
            echo 'Donezo: ' .$response->getBody();
        });

        $promise->wait();
    }

    public function showPizzaToppings($id) {
//        $request = new GuzzleHttp\Psr7\Request('GET', 'pizzas/$id');
    }

    public function create() {

    }
}
