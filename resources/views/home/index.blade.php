@extends('sections.main')

@section('content')

<div class="container p-0">

  <div class="row">

    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">Latest Selling Listings</li>
        @foreach($new_listings as $listing)
          @if($listing->selling_quantity)
          <li class="list-group-item">
            <img src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
            <p>
              <a href="/profile/{{ $listing->user->id }}">{{$listing->user->username }}</a>
              is selling {{ $listing->selling_quantity }}x
              <a href="/item/{{ $listing->item->id }}">{{$listing->item->name}}</a>
              for {{ $listing->selling_price }} {{ $listing->selling_currency }} each
            </p>
          </li>
          @endif
        @endforeach
      </ul>
    </div>

    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">Latest Buying Listings</li>
        @foreach($new_listings as $listing)
          @if($listing->buying_quantity)
          <li class="list-group-item">
            <img src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
            <p>
              <a href="/profile/{{ $listing->user->id }}">{{$listing->user->username }}</a>
              wants to buy {{ $listing->buying_quantity }}x
              <a href="/item/{{ $listing->item->id }}">{{$listing->item->name}}</a>
              for {{ $listing->buying_price }} {{ $listing->buying_currency }} each
            </p>
          </li>
          @endif
        @endforeach
      </ul>
    </div>



  </div>

</div>

@endsection('content')
