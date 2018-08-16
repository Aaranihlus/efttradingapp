@extends('sections.main')

@section('content')
<div class="container">
  <p>Profile of {{ $user->username }}</p>
</div>
@endsection
