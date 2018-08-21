@extends('sections.main')

@section('content')

<br>

<div class="container-fluid">

  <div class="row">

    <div class="col-3">
      <ul class="list-group">
        <li class="list-group-item">Latest Selling Listings</li>
        @foreach($sale_listings as $listing)
          @if($listing->quantity)
          <li class="list-group-item p-2">
            <div class="row">
              <div class="col-6">
                <img class="img-fluid mx-auto d-block" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
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

    <div class="col-3">
      <ul class="list-group">
        <li class="list-group-item">Latest Buying Listings</li>
        @foreach($buy_listings as $listing)
          @if($listing->quantity)
          <li class="list-group-item p-2">
            <div class="row">
              <div class="col-6">
                <img class="img-fluid mx-auto d-block" src="../images/{{ $listing->item->main_category }}/{{ $listing->item->image }}">
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



    <div class="col-6">
      <ul class="list-group">
        <li class="list-group-item">Browse All Listings</li>

        <li class="list-group-item p-0">
          <div id="MainCategories"></div>
        </li>

        <li class="list-group-item p-0">
          <div id="SubCategories"></div>
        </li>

        <li class="list-group-item">
          <div class="container-fluid">
              <div class="row" id="CategoryItems"></div>
          </div>
        </li>






      </ul>
    </div>



  </div>

</div>

@endsection('content')
