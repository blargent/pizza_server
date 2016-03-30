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
        $pizzas     = json_decode($res->getBody());
        $pizzas     = collect($pizzas);

        $pizzas     = $pizzas->sortBy('name');
        $pizzas     = $pizzas->unique('name');

        return view('pizzas.show', compact('pizzas'));

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
        $allToppingData = null;

        $promise    = $client->sendAsync($pizzaRequest)->then(function($response) {
            $this->pizzaData = json_decode($response->getBody());
        });
        $promise->wait();

        $this->cPizzaData = collect($this->pizzaData[$realid]);

        $pizza['id']            = $id;
        $pizza['name']          = $this->cPizzaData['name'];
        $pizza['description']   = $this->cPizzaData['description'];

        $toppingClient  = new GuzzleHttp\Client(['base_uri' => $this->baseUri]);
        $toppingRequest = new GuzzleHttp\Psr7\Request('GET', 'pizzas/' .$id .'/toppings');
        $toppingPromise = $toppingClient->sendAsync($toppingRequest)->then(function($toppingResponse) {
           $this->toppingData = json_decode($toppingResponse->getBody());
        });
        $toppingPromise->wait();



        $allToppingsClient  = new GuzzleHttp\Client(['base_uri' => $this->baseUri]);
        $allToppingsRequest = new GuzzleHttp\Psr7\Request('GET', 'toppings');
        $allToppingPromise  = $allToppingsClient->sendAsync($allToppingsRequest)->then(function($allToppingResponse) {
           $this->allToppingData = json_decode($allToppingResponse->getBody());
        });
        $allToppingPromise->wait();


        $this->allToppingData = collect($this->allToppingData);

        $usedtoppingids = collect($this->toppingData);
        $used = $usedtoppingids->pluck('topping_id');
        $used = $used->values();

        $remainingToppings = $this->allToppingData->pluck('id');
        $remainingToppings->values();
        $remainingToppings->flatten();

        $diffToppings = $remainingToppings->diff($used);

        $manualToppingPile = null;

        $diffToppings->each(function($topping, $key) {
            $this->manualToppingPile[$topping] = $this->allToppingData->where('id', $topping);
        });

        $availableToppings = collect($this->manualToppingPile)->flatten();

        $pizza['usedtoppingids']    = $used;
        $pizza['diffToppings']      = $diffToppings;
        $pizza['remainingToppings'] = $remainingToppings;
        $pizza['allToppings']       = $this->allToppingData;
        $pizza['toppings']          = $this->toppingData;
        $pizza['tcount']            = count($this->toppingData);

        return view('pizzas.showSelectedToppings', compact('pizza', 'availableToppings'));
    }

    public function addToppingsToPizza($id, Request $request) {
        // stupid offset index
        $realid = $id+1;

        $addToppingToPizzaUri = $this->baseUri .'pizzas/' .$id .'/toppings';

        $toppingToAddUri = collect(array("topping_id" => $request->selected_topping));

        $client = new GuzzleHttp\Client();
        $result = $client->request('POST', $addToppingToPizzaUri, [
           'json' => ["topping_id" => $request->selected_topping]
        ]);

//        curl -H "Content-Type: application/json" -H "Accept: application/json" https://pizzaserver.herokuapp.com/pizzas/91/toppings --data '{"topping_id": 41}'
        return redirect()->back();
    }

    public function create() {

    }
}
