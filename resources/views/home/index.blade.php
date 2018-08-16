@extends('sections.main')

@section('content')

<div class="container-fluid p-0">

  <div class="row">

    <ul>
      <li v-for="Category in MainItemCategories">@{{ Category }}</li>
    </ul>

  </div>

</div>

@endsection('content')
