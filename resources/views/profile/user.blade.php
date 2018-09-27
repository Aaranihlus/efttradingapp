@extends('sections.main')

@section('content')
<div class="container-fluid">

  <br>

  <div class="row">

    <div class="col-2">

      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>{{ auth()->user()->username }}</h2>
        </li>

        <li class="list-group-item p-0">
          <img class="img-fluid" src="storage/{{ $user->profile_picture }}">
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-4">
              <img class="img-fluid" src="{{ asset('images/discord.png') }}">
            </div>
            <div class="col-8">
              <p>Your Discord ID:</p>
              <p>{{ $user->discord_id }}</p>
            </div>
          </div>
        </li>

        <li class="list-group-item">
          <p>Completed Trades: <span>{{ $completed_trades_count }}</span></p>
          <p>Reputation: <span>{{ $user_total_rep }}</span></p>
          <p>Scam Reports: <span>{{ $scam_reports }}</span></p>
        </li>

      </ul>


      <li class="list-group-item text-center">
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




    </div>

    <div class="col-4" id="active_listings_list">
      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>My Active Listings</h2>
        </li>

        @foreach($all_listings as $k => $listing)
        <li class="list-group-item" id="pos_in_list_{{ $k }}">
          <div class="row">

            <div class="col-6">
              <img class="img-fluid mx-auto d-block" style="max-height:8vh;" alt="{{ $listing->item->name }} Image" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
            </div>

            <div class="col-4">
              <p>{{ $listing->type }}ing {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{ $listing->item->name }}</a> for {{ number_format($listing->price) }} {{ $listing->currency }} each</p>
            </div>

            <div class="col-2">
              <a href="#" data-item_id="{{ $listing->item->id }}" data-listing_type="{{ $listing->type }}" data-listing_id="{{ $listing->id }}" data-pos="{{ $k }}">&times; Remove</a>
            </div>

          </div>
        </li>
        @endforeach

      </ul>
    </div>



    <div class="col-6">
      <ul class="list-group">

        <li class="list-group-item text-center">
          <h2>Manage Items</h2>
        </li>
        <li class="list-group-item">Main Categories</li>
        <li class="list-group-item p-0" id="MainCategoriesContainer">
          <div id="MainCategories"></div>
        </li>


        <li class="list-group-item" id="SubCatHeader" style="display:none;">Sub Categories</li>
        <li class="list-group-item p-0" id="SubCategoriesContainer" style="display:none;">
          <div class="container-fluid p-0" id="SubCategories"></div>
        </li>


        <li class="list-group-item p-0" id="SelectedItemContainer" style="display:none;">
          <div class="container-fluid text-center">
            <br>
            <div class="row">
              <div class="col-4" id="SelectedItemInfo"></div>

              <div class="col-4">
                <form method="POST" id="SellingForm">
                  {{ csrf_field() }}
                  <input class="form-control" type="text" id="item_id_s" name="item_id" value="" hidden>
                  <div id="ItemSellingData"></div>
                  <button class="btn btn-primary" style="width:100%;" id="UpdateSelling">Update Selling</button>
                </form>
              </div>

              <div class="col-4">
                <form method="POST" id="BuyingForm">
                  {{ csrf_field() }}
                  <input class="form-control" type="text" id="item_id_b" name="item_id" value="" hidden>
                  <div id="ItemBuyingData"></div>
                  <button class="btn btn-primary" style="width:100%;" id="UpdateBuying">Update Buying</button>
                </form>
              </div>

            </div>
          </div>
          <br>
        </li>


        <li class="list-group-item" id="CategoryItemsContainer" style="display:none;">
          <div class="row" id="CategoryItems"></div>
        </li>

      </ul>



    </div>

  </div>

</div>
@endsection
