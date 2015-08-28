<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <title>@yield('title', 'Michael Norris')</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Source+Code+Pro:400,300|Open+Sans:400,300' rel='stylesheet' type='text/css'>

    <style>
        html {
            position: relative;
            min-height: 100%;
            width: 100%;
            margin: 0;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            width: 100%;
            margin: 0;
            margin-bottom: 60px;
            padding: 0;
            display: table;
            font-weight: 300;
            font-family: 'Open Sans', sans-serif;
            height:100%;
        }

        .container-fluid {
        }

        .container-fluid .text-muted {
            margin: 20px 0;
            padding: 0;
        }

        h1.display-4 {
            color: #607d8b;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            background: white;
        }

        ul li.nav-item {
            margin: 0;
        }

        .form-control.input-search {
            border:none;
        }
    </style>

    @yield('header')

</head>
<body>
@include('layouts.partials._navigation')

@yield('content')

@include('layouts.partials._footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

@yield('footer')

</body>
</html>