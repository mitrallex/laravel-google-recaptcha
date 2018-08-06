<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link {{ Request::url() == url('/') ? 'active' : '' }}" href="{{ action('FeedbackController@create') }}">
                    Create new
                </a>
                <a class="nav-item nav-link {{ Request::url() == url('/feedback') ? 'active' : '' }}" href="{{ action('FeedbackController@index')  }}">
                    All feedbacks
                </a>
            </div>
        </div>
    </nav>

    <div class="container">

        @yield('content')

    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
