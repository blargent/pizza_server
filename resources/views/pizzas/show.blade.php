@extends('layouts.app')

@section('content')
    <h1>Pizzas</h1>

    <ul class="list-group">
        @foreach($pizzas as $pizza)
            @if ($pizza->name != '')
                <li class="list-group-item">{{ $pizza->name }}</li>
            @endif
        @endforeach
    </ul>

@stop
