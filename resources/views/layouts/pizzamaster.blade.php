<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza Client</title>

    <!-- Bootstrap CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">--}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    {{--<link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">--}}
    <script src="{{ URL::to('assets/js/jquery-1.12.1.min.js') }}"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/ju-1.11.4/jqc-1.11.3,dt-1.10.8/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/r/ju-1.11.4/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

    <!-- DataTables -->
    {{--<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>
        body {
            padding-top: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/reportv3') }}">Reports</a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li {{ Request::is('/') ? 'class="active"' : null }}><a href="{{ URL::to('/') }}">Home</a></li>
                <li {{ Request::is('standard') ? 'class="active"' : null }}><a href="{{ URL::to('reportv3') }}">Raw Data (SORTABLE)</a></li>
                <li {{ Request::is('infinite') ? 'class="active"' : null }}><a href="javascript:alert('Report by Status will be here soon');">By Status (soon)</a></li>
                <li {{ Request::is('group') ? 'class="active"' : null }}><a href="javascript:alert('Report by Location tag will be here soon');">By location (soon)</a></li>
                {{--<li {{ Request::is('infinite') ? 'class="active"' : null }}><a href="{{ URL::to('infinite') }}">By Status (soon)</a></li>--}}
                {{--<li {{ Request::is('group') ? 'class="active"' : null }}><a href="{{ URL::to('group') }}">By location (soon)</a></li>--}}
            </ul>
        </div>
    </nav>
    @yield('content')
</div>


<!-- App scripts -->
{{--@stack('scripts')--}}
</body>
</html>