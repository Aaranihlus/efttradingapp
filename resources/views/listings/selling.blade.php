@extends('sections.main')

@section('content')

<br>

<div class="container-fluid pl-5 pr-5">

  <div class="row">

    <li class="list-group-item col-12 text-center">
      <h3>All Selling Listings (Newest First)</h3>
    </li>


      @foreach($sale_listings as $listing)
      <li class="list-group-item col-2">
        <div class="row">

            <img class="img-fluid mx-auto d-block" style="max-height:8vh;" alt="{{ $listing->item->name }} Image" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">

          <div class="col-12">
            <p><a href="/profile/{{ $listing->user->username }}">{{ $listing->user->username }}</a> wants to Sell {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{ $listing->item->name }}</a> for {{ number_format($listing->price) }} {{ $listing->currency }} each</p>
          </div>

          <div class="col-12">
            @auth
              @if($listing->user->id != auth()->user()->id)
            <button class="btn btn-primary" data-name="{{ $listing->item->name }}" data-image="{{ $listing->item->image }}" data-price="{{ $listing->price }}" data-item_id="{{ $listing->item->id }}" data-lister="{{ $listing->user->id }}"
                    data-currency="{{ $listing->currency }}" data-quantity="{{ $listing->quantity }}" data-toggle="modal" data-target="#OfferModal" style="width:100%;">Buy
            </button>
              @endif
            @endauth

            @guest
              <button class="btn btn-danger" style="width:100%;" disabled>Please Login</button>
            @endguest
          </div>
        </div>
      </li>
      @endforeach


  </div>

</div>

@endsection
