@extends('layouts.app')

@section('content')
    <h1>Pizzas</h1>
    {{--<h4><a>Click here</a> to create a new pizza</h4>--}}
    <h4>Click on a Pizza below to view information and to show/add toppings</h4>
    <p>Scroll to the bottom to add a new Pizza. Yeah I know it is a long way :-p. They are sorted by name, Uppercase descending first, then lower. Cheers.</p>

    <ul class="list-group">
        @foreach($pizzas as $pizza)
            @if ($pizza->name != '')
                <li class="list-group-item"><a href="{{ URL::to('/pizzas/' .$pizza->id .'/toppings') }}">{{ $pizza->name }}</a> - <small>{{ $pizza->description }}</small></li>
            @endif
        @endforeach
    </ul>

    <form id="PizzaForm" method="POST" action="{{ URL::to('/pizzas') }}">
        <div class="form-group">
            <label for="pizza_name">Name of new Pizza</label>
            <textarea name="pizza_name" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="pizza_description">Description of new Pizza</label>
            <textarea name="pizza_description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add new Pizza</button>
        </div>
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </form>


@stop
