<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp;

class ToppingsController extends Controller
{
    private $baseURI = 'https://pizzaserver.herokuapp.com/';

    public function index() {
        $client = new GuzzleHttp\Client();
        $res    = $client->request('GET', $this->baseURI . 'toppings');

        $statusCode = $res->getStatusCode();
//        echo $res->getStatusCode();

        // in future test status.code and switch on status
        if ($statusCode == 200) {
            echo $res->getBody();
        }



    }

    public function create() {

    }

}
