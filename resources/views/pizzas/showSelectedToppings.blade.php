@extends('layouts.app')

@section('content')
    <h1>Pizza: {{ $pizza['name'] }}</h1>
    <h3>Pizza description: {{ $pizza['description'] }}</h3>

    <br>
        @if ($pizza['tcount'] > 0)
            <p>This pizza has the following toppings applied to it.</p><p> You may click to add toppings from the available radio button list or <a href="{{ URL::to('/toppings') }}">create new toppings here</a></p>
        @else
            <p>This pizza has no toppings applied. So sad. You may select some toppings from the ones listed bleow or or <a href="{{ URL::to('/toppings') }}">create new toppings here</a></p>
        @endif

    <ul class="list-group">
        @foreach($pizza['toppings'] as $topping)
            @if ($topping->name != '')
                <li class="list-group-item">{{ $topping->name }}</li>
            @else
                <li class="list-group-item">There is no name for this topping, that is weird...</li>
            @endif
        @endforeach
    </ul>

    <form id="pizzaForm" method="POST" action="{{ URL::to('/pizzas/' .$pizza['id'] .'/toppings') }}">
        <div class="form-group">
            @foreach($availableToppings as $availableTopping)
                <input type="radio" name="selected_topping" value="{{ $availableTopping->id }}"> {{ $availableTopping->name }}
                {{--<div class="checkbox">--}}
                {{--{!! Form::checkbox('topping_selected[]', $availableTopping->id) !!}--}}
                {{--{!! $availableTopping->name !!}--}}
                {{--<input name="topping" type="checkbox" value="1" id="{{ $availableTopping->id }}"> {{ $availableTopping->name }}--}}
                    {{--{!! Form::checkbox('items[]', $availableTopping->id) !!}}--}}
                {{--</div>--}}
            @endforeach
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add a topping (this demo states "a" singular)</button>
        </div>
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </form>
@stop
