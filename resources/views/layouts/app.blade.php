<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Hedwig</title>

  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
  <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

  <div id="app">

    @include('layouts/toolbar')

    <div class="container">
      @yield('content')
    </div>
  
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.0/axios.js"></script>
  <script>
      window.Laravel = {
          'csrfToken': '{{ csrf_token() }}',
      };
  </script>
  <script src="//localhost:6001/socket.io/socket.io.js"></script>
  <script src="{{ asset('/js/echo.js') }}"></script>
  <script>
      if (typeof io === "undefined"){
        alert('Please check your laravel-echo-server status!');
      }
  </script>
  <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
