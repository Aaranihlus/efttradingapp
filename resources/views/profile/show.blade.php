@extends('sections.main')

@section('content')
<br>

<div class="container-fluid">

  <div class="row">


    <div class="col-2">

      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>{{ $user->username }}</h2>
        </li>

        <li class="list-group-item p-0">
          <img class="img-fluid" src="../storage/{{ $user->profile_picture }}">
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-4">
              <img class="img-fluid" src="{{ asset('images/discord.png') }}">
            </div>
            <div class="col-8">
              <p>{{ $user->username }}'s Discord ID:</p>
              <p>{{ $user->discord_id }}</p>
            </div>
          </div>
        </li>

        <li class="list-group-item">
          <p>Completed Trades: <span>{{ $completed_trades_count }}</span></p>
          <p>Reputation: <span>{{ $user_total_rep }}</span></p>
          <p>Scam Reports: <span>{{ $scam_reports }}</span></p>
        </li>

        <li class="list-group-item">
          <p>Recent Reviews:</p>
          @foreach($completed_trades as $trade)
            @foreach($trade->reviews as $review)
              @if($review->reviewer_id != $user->id)
                <p>({{ $review->created_at->diffForHumans() }}) <a href="/profile/{{ $review->reviewer->username }}">{{ $review->reviewer->username }}</a>: {{ $review->comment }}
                @if($review->type == "positive")
                  <i style="color:green" class="fas fa-thumbs-up"> +</i>
                @else
                  <i style="color:red" class="fas fa-thumbs-down"> -</i>
                @endif
                </p>
              @endif
            @endforeach
          @endforeach
        </li>

      </ul>
    </div>



    @if(count($sale_listings))
    <div class="col-5">
      <ul class="list-group">
        <li class="list-group-item">{{ $user->username }} is selling</li>
        @foreach($sale_listings as $listing)
          @if($listing->quantity)
          <li class="list-group-item">
            <div class="row">
              <div class="col-5">
                <img class="img-fluid" style="max-height: 8vh;" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
              </div>
              <div class="col-5">
                <p><a href="/profile/{{ $listing->user->username }}">{{ $listing->user->username }}</a> is selling {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{ $listing->item->name }}</a> for {{ $listing->price }} {{ $listing->currency }} each</p>
              </div>

              <div class="col-2">


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
          @endif
        @endforeach
      </ul>
    </div>
    @else
    <div class="col-5">
      <ul class="list-group">
        <li class="list-group-item">
          <h2>{{ $user->username }} is not selling any items.</h2>
        </li>
      </ul>
    </div>
    @endif

    @if(count($buy_listings))
    <div class="col-5">
      <ul class="list-group">
        <li class="list-group-item">{{ $user->username }} is buying</li>
        @foreach($buy_listings as $listing)
          @if($listing->quantity)
          <li class="list-group-item">
            <div class="row">
              <div class="col-5">
                <img class="img-fluid" style="max-height: 8vh;" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
              </div>
              <div class="col-5">
                <p><a href="/profile/{{ $listing->user->username }}">{{$listing->user->username }}</a> wants to buy {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{$listing->item->name}}</a> for {{ $listing->price }} {{ $listing->currency }} each</p>
              </div>


              <div class="col-2">

                @auth
                  @if($listing->user->id != auth()->user()->id)
                  <button class="btn btn-primary" data-name="{{ $listing->item->name }}" data-image="{{ $listing->item->image }}" data-item_id="{{ $listing->item->id }}" data-price="{{ $listing->price }}" data-lister="{{ $listing->user->id }}"
                          data-currency="{{ $listing->currency }}" data-quantity="{{ $listing->quantity }}" data-toggle="modal" data-target="#OfferModal" style="width:100%;">Sell
                  </button>
                  @endif
                @endauth

                @guest
                  <button class="btn btn-danger" style="width:100%;" disabled>Please Login</button>
                @endguest

              </div>


            </div>
          </li>
          @endif
        @endforeach
      </ul>
    </div>
    @else
    <div class="col-5">
      <ul class="list-group">
        <li class="list-group-item">
          <h2>{{ $user->username }} is not buying any items.</h2>
        </li>
      </ul>
    </div>
    @endif




  </div>

</div>


@endsection
