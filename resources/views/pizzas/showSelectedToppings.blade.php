@extends('layouts.app')

@section('content')
    <h1>Pizza: {{ $pizza['name'] }}</h1>
    <h3>Pizza description: {{ $pizza['description'] }}</h3>

    <br><p>This pizza has the following toppings applied to it. You may click to add toppings from the available list or create new toppings here</p>

    <ul class="list-group">
        @foreach($pizza['toppings'] as $topping)
            @if ($topping->name != '')
                <li class="list-group-item">{{ $topping->name }}</li>
            @else
                <li class="list-group-item">There are no toppings on this pizza yet. What a shame!</li>
            @endif
        @endforeach
    </ul>

@stop
