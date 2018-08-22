@extends('sections.main')

@section('content')
<br>

<div class="container-fluid">

  <div class="row">

    @if(count($sale_listings))
    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">Chungus is selling</li>
        @foreach($sale_listings as $listing)
          @if($listing->quantity)
          <li class="list-group-item">
            <div class="row">
              <div class="col-6">
                <img class="img-fluid" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
              </div>
              <div class="col-6">
                <p><a href="/profile/{{ $listing->user->username }}">{{$listing->user->username }}</a> is selling {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{ $listing->item->name }}</a> for {{ $listing->price }} {{ $listing->currency }} each</p>
              </div>
            </div>
          </li>
          @endif
        @endforeach
      </ul>
    </div>
    @else
    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">
          <h2>Chungus is not selling any items.</h2>
        </li>
      </ul>
    </div>
    @endif

    @if(count($sale_listings))
    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">Chungus is buying</li>
        @foreach($buy_listings as $listing)
          @if($listing->quantity)
          <li class="list-group-item">
            <div class="row">
              <div class="col-6">
                <img class="img-fluid" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
              </div>
              <div class="col-6">
                <p><a href="/profile/{{ $listing->user->username }}">{{$listing->user->username }}</a> wants to buy {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{$listing->item->name}}</a> for {{ $listing->price }} {{ $listing->currency }} each</p>
            </div>
            </div>
          </li>
          @endif
        @endforeach
      </ul>
    </div>
    @else
    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">
          <h2>Chungus is not buying any items.</h2>
        </li>
      </ul>
    </div>
    @endif




  </div>

</div>


@endsection
