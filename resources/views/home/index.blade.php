@extends('sections.main')

@section('content')

<br>

<div class="container-fluid">

  <div class="row">

    <div class="col-3">
      <ul class="list-group">
        <li class="list-group-item">
          <h3>Latest Selling Listings</h3>
        </li>
        @foreach($sale_listings as $listing)
          @if($listing->quantity)
          <li class="list-group-item p-2">
            <div class="row">
              <div class="col-6">
                <img class="img-fluid mx-auto d-block" alt="{{ $listing->item->name }} Image" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
              </div>
              <div class="col-6">
                <p><a href="/profile/{{ $listing->user->username }}">{{$listing->user->username }}</a> is selling {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{ $listing->item->name }}</a> for {{ number_format($listing->price) }} {{ $listing->currency }} each</p>
              </div>
            </div>
          </li>
          @endif
        @endforeach
      </ul>
    </div>

    <div class="col-3">
      <ul class="list-group">
        <li class="list-group-item">
          <h3>Latest Buying Listings</h3>
        </li>
        @foreach($buy_listings as $listing)
          @if($listing->quantity)
          <li class="list-group-item p-2">
            <div class="row">
              <div class="col-6">
                <img class="img-fluid mx-auto d-block" alt="{{ $listing->item->name }} Image" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
              </div>
              <div class="col-6">
                <p><a href="/profile/{{ $listing->user->username }}">{{ $listing->user->username }}</a> wants to buy {{ $listing->quantity }}x <a href="/item/{{ $listing->item->id }}">{{ $listing->item->name }}</a> for {{ number_format($listing->price) }} {{ $listing->currency }} each</p>
              </div>
            </div>
          </li>
          @endif
        @endforeach
      </ul>
    </div>



    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">
          <h3>Search Listings<h3>
        </li>

        <li class="list-group-item p-0">
          <div class="row m-0">
            <a href="/listings/all" class="btn btn-primary" style="color:black;">All Listings</a>
            <a href="/listings/selling" class="btn btn-primary" style="color:black;">All Selling</a>
            <a href="/listings/buying" class="btn btn-primary" style="color:black;">All Buying</a>
            <a class="btn btn-primary" style="color:black;" id="specific_item_view">Specific Item</a>
          </div>
        </li>

        <div id="item_view_container" style="display:none;">

          <li class="list-group-item">Main Categories</li>
          <li class="list-group-item p-0" id="MainCategoriesContainer">
            <div id="MainCategories"></div>
          </li>


          <li class="list-group-item" id="SubCatHeader" style="display:none;">Sub Categories</li>
          <li class="list-group-item p-0" id="SubCategoriesContainer" style="display:none;">
            <div class="container-fluid p-0" id="SubCategories"></div>
          </li>

          <li class="list-group-item">
            <div class="container-fluid">
                <div class="row" id="CategoryItems"></div>
            </div>
          </li>

        </div>






      </ul>
    </div>



  </div>

</div>

@endsection('content')
