<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <title>@yield('title', 'Michael Norris')</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

    <style>
        html {
            position: relative;
            min-height: 100%;
            width: 100%;
            margin: 0;
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
            background: #eceff1;
        }

        .container-fluid {
            padding: 0;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            background: white;
        }

        .container-fluid .text-muted {
            margin: 20px 0;
            padding: 0;
        }
    </style>

    @yield('header')

</head>
<body>
@yield('content')

@include('layouts.partials._footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

@yield('footer')

</body>
</html>