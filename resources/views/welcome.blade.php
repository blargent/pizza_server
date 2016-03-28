@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome to the SRPSCA! (Super Awesome Pizza Server Client App)</div>

                    <div class="panel-body">
                        @if (Auth::guest())
                            <p>Hello, please proceed to the <a href="{{ url('/pizzas') }}">Pizza Page</a>. You will need to login first.</p>
                        @else
                            <p>You are now logged in.</p>
                            <p>Please proceed to the <a href="{{ url('/pizzas') }}">Pizza Page</a>, or the <a href="{{ url('/pizzas') }}">Toppings Page</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
