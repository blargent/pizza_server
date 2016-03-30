@extends('layouts.app')

@section('content')
    <h1>Pizzas</h1>
    <h4><a>Click here</a> to create a new pizza</h4>
    <h4>Click on a Pizza below to view information and to show/add toppings</h4>

    <ul class="list-group">
        @foreach($pizzas as $pizza)
            @if ($pizza->name != '')
                <li class="list-group-item"><a href="{{ URL::to('/pizzas/' .$pizza->id .'/toppings') }}">{{ $pizza->name }}</a></li>
            @endif
        @endforeach
    </ul>

@stop
