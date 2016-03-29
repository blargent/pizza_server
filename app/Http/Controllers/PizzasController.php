<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

use GuzzleHttp;

class PizzasController extends Controller
{
    private $client;

    private $baseUri = 'https://pizzaserver.herokuapp.com/';

//    public function __construct() {
//        $this->client = new GuzzleHttp\Client(['base_uri' => 'https://pizzaserver.herokuapp.com/']);
//    }

    /***
     *
     * The /pizzas endpoint should show return all of the pizzas.
     *
     */
    public function index() {
        $client = new GuzzleHttp\Client();
        $res    = $client->request('GET', 'https://pizzaserver.herokuapp.com/pizzas');
//        $res    = $this->client->request('GET', 'pizzas');
        $pizzas     = json_decode($res->getBody());
        $pizzas     = collect($pizzas);

//        dd($pizzas);
        $pizzas     = $pizzas->unique('name');

        return view('pizzas.show', compact('pizzas'));

//        $request = new GuzzleHttp\Psr7\Request('GET', 'pizzas');
//        $promise = $this->client->sendAsync($request)->then(function($response) {
//            $gdata = json_decode($response->getBody());
//            return view('pizzas.show', compact('gdata'));
//        });
//        $promise->wait();
    }

    /**
     * @param $id
     *
     * The /pizzas/{pizza_id_slug}/toppings endpoint should return the toppings for the
     * specified pizza.
     *
     * If I were reading from a db rather than guzzle request of an API I would make this
     * an association in the Pizza model and inverse in the Topping model and no logic would
     * need to go here in the controller, as:
     *
     *   Pizza   -> hasMany('App\Toppings')    and
     *   Topping -> belongsTo('App\Pizza')  (or belongsToMany).
     */
//    public function showPizzaToppings($id, $name, $description) {
    public function showPizzaToppings($id) {
        // stupid index 1 offset from api :-p
        $realid = $id-1;
        $client          = new GuzzleHttp\Client(['base_uri' => $this->baseUri]);
        $pizzaRequest    = new GuzzleHttp\Psr7\Request('GET', 'pizzas');

        $pizzaData      = null;
        $toppingData    = null;
        $cPizzaData     = null;

        $promise    = $client->sendAsync($pizzaRequest)->then(function($response) {
            $this->pizzaData = json_decode($response->getBody());
        });
        $promise->wait();

        $this->cPizzaData = collect($this->pizzaData[$realid]);
//        dd($this->cPizzaData);

        $pizza['id']            = $realid;
        $pizza['name']          = $this->cPizzaData['name'];
//        $pizza['name']          = $this->pizzaData[$id]->name;
        $pizza['description']   = $this->cPizzaData['description'];
//        $pizza['description']   = $this->pizzaData[$id]->description;
//        dd($pizza);

        $toppingClient  = new GuzzleHttp\Client(['base_uri' => $this->baseUri]);
        $toppingRequest = new GuzzleHttp\Psr7\Request('GET', 'pizzas/' .$id .'/toppings');

        $toppingPromise = $toppingClient->sendAsync($toppingRequest)->then(function($toppingResponse) {
           $this->toppingData = json_decode($toppingResponse->getBody());
        });
        $toppingPromise->wait();

//        $this->toppingData = collect($this->toppingData);

        $pizza['toppings']      = $this->toppingData;


        return view('pizzas.showSelectedToppings', compact('pizza'));
//        return view('pizzas.showSelectedToppings', compact('pToppings'));
//        return view('pizzas.showSelectedToppings', compact('pToppings', 'name', $description));
//        dd($pToppings);

//        dd(json_decode($request->getBody()));
//        $request = new GuzzleHttp\Psr7\Request('GET', 'pizzas/' .$id .'/toppings');

    }

    public function addToppingToPizza($id, $toppingId) {

    }

    public function create() {

    }
}
