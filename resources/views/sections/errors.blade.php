@if(count($errors))
  <div class="alert alert-danger" id="error_panel" role="alert">
    @foreach ($errors->all() as $error )
      {{ $error }}<br>
    @endforeach
  </div>
@endif
