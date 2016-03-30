@extends('layouts.app')

@section('content')
    <h1>Toppings</h1>

    <ul class="list-group">
        @foreach($toppings as $topping)
            @if ($topping->name != '')
                <li class="list-group-item">{{ $topping->name }}</li>
            @endif
        @endforeach
    </ul>

    <form id="pizzaForm" method="POST" action="{{ URL::to('/toppings) }}">
        <div class="form-group">

        </div>
    </form>


@stop
