@extends('sections.main')

@section('content')

<br>

<div class="container-fluid">

  <div class="row">

    <div class="col-3">
      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>Offer Information</h2>
        </li>
        <li class="list-group-item">
          <p>Offer #{{ $offer->id }}</p>
          <p>Status: {{ $offer->status }}</p>
          <p>Sent: {{ $offer->created_at->diffForHumans() }}</p>
          <p>From: {{ $offer->sender->username }}</p>
          <p>To: {{ $offer->recipient->username }}</p>
        </li>
      </ul>

      <hr>

      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>Offer Actions</h2>
        </li>
        <li class="list-group-item">
          <button class="btn btn-primary" style="width:100%; margin-bottom:3px;" type="submit" id="openCompleteModal" data-toggle="modal" data-target="#OfferCompleteModal">Mark as Completed</button>
          <button class="btn btn-primary" style="width:100%; margin-bottom:3px;" type="submit" id="openCancelModal" data-toggle="modal" data-target="#OfferCancelModal">Cancel This Trade</button>
          <button class="btn btn-primary" style="width:100%;" type="submit" data-toggle="modal" data-target="#OfferScamModal">Report a Scam</button>
        </li>
      </ul>
    </div>

    <div class="col-6">
      <ul class="list-group">

        <li class="list-group-item text-center">
          <h2>Live Chat</h2>
        </li>

        <li class="list-group-item" id="offer_messages" style="overflow-y:scroll; max-height:60vh;">
          <div class="alert alert-info text-center" role="alert"><strong>Note:</strong> All Messages are recorded</div>

          @if(count($offer_messages))
            <div class="text-left">
            @foreach($offer_messages as $message)
              <p>({{ $message->created_at->diffForHumans() }}) {{ $message->username }}: {{ $message->message }}</p>
            @endforeach
          </div>
          @else
            <p id="no_messages_info">No Messages here yet</p>
          @endif
        </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col-10">
              <form method="POST" action="/send_offer_message" id="New_Message_Form">
                <input type="hidden" name="offer_id" value="{{ $offer->id }}" id="offer_message_offer_id">
                <input type="hidden" name="username" value="{{ auth()->user()->username }}" id="offer_message_username">

                @if(auth()->user()->id == $offer->sender->id)
                  <input type="hidden" name="message_recipient_id" value="{{ $offer->recipient->id }}" id="message_recipient_id">
                @endif

                @if(auth()->user()->id == $offer->recipient->id)
                  <input type="hidden" name="message_recipient_id" value="{{ $offer->sender->id }}" id="message_recipient_id">
                @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="offer_message_username">
                <input style="width:100%;" type="text" name="message" id="offer_message_message">
              </form>
            </div>
            <div class="col-2">
              <button class="btn btn-primary" style="width:100%;" type="submit" id="offer_message_send">Send</button>

            </div>
          </div>
        </li>
      </ul>
    </div>

    <div class="col-3">
      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>Item Information</h2>
        </li>
        <li class="list-group-item">
          <p>Item: {{ $offer_item->item->name }}</p>
          <img class="img-fluid mx-auto d-block" src="../images/{{ $offer_item->item->main_category }}/{{ $offer_item->item->image }}">
          <p>Quantity: {{ $offer_item->quantity }}</p>
          <p>Price per unit: {{ number_format($offer_item->price) }} {{ $offer_item->currency }}</p>
          <p>Offer Total: {{ ( number_format($offer_item->price  * $offer_item->quantity) ) }} {{ $offer_item->currency }} </p>
        </li>
      </ul>

    </div>

  </div>

</div>
@endsection
