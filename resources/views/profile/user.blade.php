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
    </div>

    <div class="col-4">
      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>Recent Reviews</h2>
        </li>

        <li class="list-group-item">
          @foreach($completed_trades as $trade)

            @foreach($trade->reviews as $review)

              @if($review->reviewer_id != auth()->user()->id)

                <p>({{ $review->created_at->diffForHumans() }}) {{ $review->reviewer->username }}: {{ $review->comment }}
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



    <div class="col-6">
      <ul class="list-group">

        <li class="list-group-item text-center">
          <h2>Your Items</h2>
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
