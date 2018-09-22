@extends('sections.main')

@section('content')

<br>

<div class="container-fluid">

  <div class="row">

    @if(count($received_offers))
    <div class="col-6">

      <ul class="list-group text-center" id="recieved_offers_list">
        <li class="list-group-item">
          <h2>Recieved offers</h2>
        </li>
        @foreach($received_offers as $offer)

        <li class="list-group-item" id="offer-{{$offer->id}}">
          <div class="row">
            <div class="col-4">
              <p>{{ $offer->sender->username }} sent you an offer ({{ $offer->created_at->diffForHumans() }})</p>
            </div>
            <div class="col-5">
              <p>{{ $offer->offer_info->quantity }}x {{ $offer->item[0]->name }} for {{ number_format($offer->offer_info->price) }} {{ $offer->offer_info->currency }} each</p>
            </div>
            <div class="col-3">
              <a href="/offer/{{ $offer->id }}">View Offer</a>&nbsp;&nbsp;
              <a data-id="{{ $offer->id }}">Remove Offer</a>
            </div>
          </div>
        </li>

        @endforeach
      </ul>

    </div>
    @else
      <div class="col-6">
        <ul class="list-group text-center">
          <li class="list-group-item">
            <h2>Recieved offers</h2>
          </li>
          <li class="list-group-item">
            <p>You have not recieved any offers</p>
          </li>
        <ul>
      </div>
    @endif


    @if(count($sent_offers))
    <div class="col-6">

      <ul class="list-group text-center" id="sent_offers_list">
        <li class="list-group-item">
          <h2>Sent offers</h2>
        </li>
        @foreach($sent_offers as $offer)

        <li class="list-group-item">
          <div class="row">
            <div class="col-4">
              <p>You sent an offer to {{ $offer->recipient->username }} ({{ $offer->created_at->diffForHumans() }})</p>
            </div>
            <div class="col-5">
              <p>{{ $offer->offer_info->quantity }}x {{ $offer->item[0]->name }} for {{ number_format($offer->offer_info->price) }} {{ $offer->offer_info->currency }} each</p>
            </div>
            <div class="col-3">
              <a href="/offer/{{ $offer->id }}">View Offer</a>&nbsp;&nbsp;
              <a href="#">Remove Offer</a>
            </div>
          </div>
        </li>

        @endforeach
      </ul>

    </div>
    @else
    <div class="col-6">
      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>Sent offers</h2>
        </li>
        <li class="list-group-item">
          <p>You have not sent any offers</p>
        </li>
      <ul>
    </div>
    @endif

  </div>

</div>
@endsection
