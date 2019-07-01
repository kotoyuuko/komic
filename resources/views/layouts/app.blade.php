<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=0.6, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'komic')</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app" class="{{ route_class() }}-page">
    @yield('app')
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
