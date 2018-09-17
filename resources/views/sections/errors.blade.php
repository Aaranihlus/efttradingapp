@if(count($errors))
  <div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error )
      <p id="error_line">{{ $error }}</p>
    @endforeach
  </div>
@endif
