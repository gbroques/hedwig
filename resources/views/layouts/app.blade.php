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
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>

  <div id="app">

    @include('layouts.toolbar')

    <div class="container">
      <page-title class="page-title">@{{ $route.name }}</page-title>

      @yield('content')
    </div>
  
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.0/axios.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.js"></script>
  <script src="js/app.js"></script>

</body>
</html>
