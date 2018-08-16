@extends('sections.main')

@section('content')
<div class="container">

  <p>Login</p>
  <form method="POST" method="/login">
    {{ csrf_field() }}
    <p>email</p>
    <input type="text" name="email">
    <p>password</p>
    <input type="password" name="password">
    <button type="submit">Login</button>
  </form>
</div>

<div class="container">
  @include('sections.errors')
</div>

@endsection('content')
