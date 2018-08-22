<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EFT Market</title>
  <link rel="stylesheet" href="../css/app.css">
</head>

<body>
  <div class="container-fluid p-0" id="app">
    @include ('sections.navigation')
    @yield ('content')
    @include ('sections.footer')
  </div>

  <script src="../js/app.js"></script>
</body>



</html>
