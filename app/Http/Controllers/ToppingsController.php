<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use GuzzleHttp;

class ToppingsController extends Controller
{
    private $client;
    private $baseURI = 'https://pizzaserver.herokuapp.com/toppings';

//    public function __construct() {
//        $this->client = new GuzzleHttp\Client(['base_uri' => 'https://pizzaserver.herokuapp.com/']);
//    }

    public function index() {
        $client = new GuzzleHttp\Client();

        $res    = $client->request('GET', $this->baseURI);

        $toppings     = json_decode($res->getBody());
        $toppings     = collect($toppings);
        $toppings     = $toppings->sortBy('name');
//        $toppings     = $toppings->unique('name');

        return view('toppings.show', compact('toppings'));
    }

    public function createTopping(Request $request) {
        $client = new GuzzleHttp\Client();

        $result = $client->request('POST', $this->baseURI, [
            'json' => ["topping" => ["name" => $request->topping_name]]
        ]);

//        curl -H "Content-Type: application/json" -H "Accept: application/json" https://pizzaserver.herokuapp.com/pizzas/91/toppings --data '{"topping_id": 41}'
        return redirect()->back();
    }

}
