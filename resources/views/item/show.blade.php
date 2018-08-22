@extends('sections.main')

@section('content')

<br>

<div class="container-fluid">

  <div class="row">

    @if(count($sale_listings))
    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">Selling Listings</li>
        @foreach($sale_listings as $listing)
        @if($listing->quantity)
        <li class="list-group-item">
          <div class="row">
            <div class="col-5">
              <img class="img-fluid" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
            </div>
            <div class="col-5">
              <p><a href="/profile/{{ $listing->user->username }}">{{ $listing->user->username }}</a> is selling {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{ $listing->item->name }}</a> for {{ $listing->price }} {{ $listing->currency }} each</p>
            </div>
            <div class="col-2">
              <button class="btn btn-primary" data-name="{{ $listing->item->name }}" data-image="{{ $listing->item->image }}" data-price="{{ $listing->price }}"
                      data-currency="{{ $listing->currency }}" data-quantity="{{ $listing->quantity }}" data-toggle="modal" data-target="#OfferModal" style="width:100%;">Buy
              </button>
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
          <h2>There are no sale listings for this item yet. Create one <a href="/profile">here</a>.</h2>
        </li>
      </ul>
    </div>
    @endif

    @if(count($buy_listings))
    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">Buying Listings</li>
        @foreach($buy_listings as $listing)
        @if($listing->quantity)
        <li class="list-group-item">
          <div class="row">
            <div class="col-5">
              <img class="img-fluid" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
            </div>
            <div class="col-5">
              <p><a href="/profile/{{ $listing->user->username }}">{{ $listing->user->username }}</a> wants to buy {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{ $listing->item->name }}</a> for {{ $listing->price }} {{ $listing->currency }} each</p>
            </div>
            <div class="col-2">
              <button class="btn btn-primary" data-name="{{ $listing->item->name }}" data-image="{{ $listing->item->image }}" data-price="{{ $listing->price }}"
                      data-currency="{{ $listing->currency }}" data-quantity="{{ $listing->quantity }}" data-toggle="modal" data-target="#OfferModal" style="width:100%;">Sell
              </button>
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
          <h2>There are no buy listings for this item yet. Create one <a href="/profile">here</a>.</h2>
        </li>
      </ul>
    </div>
    @endif


  </div>


</div>
@endsection
