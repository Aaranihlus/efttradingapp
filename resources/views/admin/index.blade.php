@extends('sections.main')

@section('content')

<br>

<div class="container-fluid">

  <ul class="list-group text-center">
    <li class="list-group-item">
      <h2>Welcome back, {{ auth()->user()->username }}</h2>
    </li>
  </ul>

  <br>

  <div class="row">

    <div class="col-3">

      <ul class="list-group text-center">
        <li class="list-group-item">
          <button style="width:45%" class="btn btn-primary" id="shutdown_server_button">Shut Down Server</button>
          <button style="width:45%" class="btn btn-primary" id="boot_server_button">Boot The Server</button>
        </li>
      </ul>



    </div>


  </div>



</div>

@endsection
