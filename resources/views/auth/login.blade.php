@extends('sections.main')

@section('content')
<div class="container" style="width:33%; margin-top:12.5%;">

  <ul class="list-group">

    <li class="list-group-item">
      <h1>//Authorisation</h1>
    </li>

    <form method="POST" method="/login">

      {{ csrf_field() }}

      <li class="list-group-item">
        <div class="form-group row">
          <label for="username" class="col-2 col-form-label">Username</label>
          <div class="col-10">
            <input class="form-control" type="username" id="email" name="username" required>
          </div>
        </div>
      </li>

      <li class="list-group-item">
        <div class="form-group row">
          <label for="password" class="col-2 col-form-label">Password</label>
          <div class="col-10">
            <input class="form-control" type="password" id="password" name="password" required>
          </div>
        </div>
      </li>

      <li class="list-group-item">
        <div class="row">
          <div class="col-6">
            <button class="btn btn-primary" style="width:100%;" type="submit">Submit</button>
          </div>
          <div class="col-6">
            <p>Don't have an account? Sign up <a href="/register">here</a></p>
          </div>
        </div>
      </li>

    </form>

  </ul>

  <br>

  @include('sections.errors')

</div>

@endsection('content')
