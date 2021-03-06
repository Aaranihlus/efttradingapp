<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta id="csrf_header" name="csrf-token" content="{{ csrf_token() }}">
  <title>EFT Market</title>
  <link rel="stylesheet" href="../css/app.css">
</head>

  <body>
    <div class="container-fluid p-0" id="app" @auth data-uid="{{ auth()->user()->id }}" @endauth>

      @include ('sections.navigation')

      @yield ('content')

      @include ('sections.globalchat')

      @include ('sections.footer')
    </div>

  <script src="../js/app.js"></script>

  </body>

</html>
