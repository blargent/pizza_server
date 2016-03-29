<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use GuzzleHttp;

class ToppingsController extends Controller
{
    private $client;
    //    private $baseURI = 'https://pizzaserver.herokuapp.com/';

public function __construct() {
    $this->client = new GuzzleHttp\Client(['base_uri' => 'https://pizzaserver.herokuapp.com/']);
}

    public function index() {
        // $client  = new GuzzleHttp\Client();
        $request = new GuzzleHttp\Psr7\Request('GET', 'toppings');
        // $request = new GuzzleHttp\Psr7\Request('GET', $this->baseURI .'toppings');

        $promise = $this->client->sendAsync($request)->then(function($response) {
            echo 'Donezo: ' .$response->getBody();
        });

        $promise->wait();
    }


    /*    public function index() {
        $client = new GuzzleHttp\Client();
        $res    = $client->request('GET', $this->baseURI . 'toppings');

        $statusCode = $res->getStatusCode();
        $reasonCode = $res->getReasonCode();
        // echo $res->getStatusCode();

        // in future test status.code and switch on status
        if ($statusCode == 200) {
            echo $res->getBody();
        }
    }
*/

    public function create() {

    }

}
