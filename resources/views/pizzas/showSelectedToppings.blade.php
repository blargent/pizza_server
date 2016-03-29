@extends('layouts.app')

@section('content')
    <h1>Pizza: {{ $pizza['name'] }}</h1>
    <h3>Pizza description: {{ $pizza['description'] }}</h3>

    <br>
        @if ($pizza['tcount'] > 0)
            <p>This pizza has the following toppings applied to it. You may click to add toppings from the available list or create new toppings here</p>
        @else
            <p>This pizza has no toppings applied. So sad. You may select some toppings from the ones listed bleow or create new toppings here.</p>
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

    <form>
    <div class="form-group">

    </div>
    </form>
@stop
