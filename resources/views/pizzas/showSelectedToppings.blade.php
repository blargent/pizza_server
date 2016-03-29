@extends('layouts.app')

@section('content')
    <h1>Pizza: {{ $pizza['name'] }}</h1>
    <h3>Pizza description: {{ $pizza['description'] }}</h3>

    <ul class="list-group">
        @foreach($pizza['toppings'] as $topping)
            @if ($topping->name != '')
                <li class="list-group-item">{{ $topping->name }}</li>
            @endif
        @endforeach
    </ul>

@stop
