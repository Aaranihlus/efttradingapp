@extends('sections.main')

@section('content')

<br>

<div class="container-fluid">

  <div class="row">
    @if(count($offers))

        @foreach($offers as $offer)
          <p>{{$offer}}</p>
          <a href="/offer/{{ $offer->id }}">Go to offer</a>
        @endforeach
      </ul>
    @else
      <p>No offers found</p>
    @endif

  </div>

</div>
@endsection
