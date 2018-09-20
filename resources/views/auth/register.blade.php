@extends('sections.main')

@section('content')

<div class="container" style="width:33%; margin-top:3%;">

  <div class="container">
    @include('sections.errors')
  </div>

  <ul class="list-group">

    <li class="list-group-item">
      <h1>Register a new account</h1>
    </li>


    <form method="POST" action="/register" enctype="multipart/form-data">
      {{ csrf_field() }}

      <li class="list-group-item">
        <div class="form-group">
          <label for="username">EFT Username</label>
          <input class="form-control" type="text" id="username" name="username" required>
        </div>
      </li>

      <li class="list-group-item">
        <div class="form-group">
          <label for="email">Email Address</label>
          <input class="form-control" type="email" id="email" name="email" required>
        </div>
      </li>

      <li class="list-group-item">
        <div class="form-group">
          <label for="discord_id">Discord ID (Optional)</label>
          <input class="form-control" type="text" id="discord_id" name="discord_id" placeholder="username#4225">
        </div>
      </li>

      <li class="list-group-item">
        <div class="form-group">
          <label for="profile_picture">Profile Picture</label>
          <input type="file" id="profile_picture" name="profile_picture">
        </div>
      </li>

      <li class="list-group-item">
        <div class="form-group">
          <label for="password">Password</label>
          <input class="form-control" type="password" id="password" name="password" required>
        </div>
      </li>

      <li class="list-group-item">
        <div class="form-group">
          <label for="password_confirmation">Password Confirmation</label>
          <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
      </li>

      <li class="list-group-item">
        <div class="row">
          <div class="col-6">
            <button class="btn btn-primary" style="width:100%;" type="submit">Submit</button>
          </div>
          <div class="col-6">
            <p>Already have an account? Sign in <a href="/login">here</a></p>
          </div>
        </div>
      </li>

    </form>

  </div>

  @endsection('content')
