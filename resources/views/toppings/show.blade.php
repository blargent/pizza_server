@extends('layouts.app')

@section('content')
    <h1>Toppings</h1>

    <p>Scroll to the bottom to add a new topping. They are sorted by name, Uppercase descending first, then lower. Cheers.</p>

    <ul class="list-group">
        @foreach($toppings as $topping)
            @if ($topping->name != '')
                <li class="list-group-item">{{ $topping->name }}</li>
            @endif
        @endforeach
    </ul>

    <form id="toppingsForm" method="POST" action="{{ URL::to('/toppings') }}">
        <div class="form-group">
            <textarea name="topping_name" class="form-control"></textarea>

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add topping</button>
        </div>
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </form>


@stop
