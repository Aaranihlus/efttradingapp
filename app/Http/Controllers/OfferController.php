<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\OfferItems;
use App\Item;
use App\Events\NewMessage;
use App\Events\NewOfferNotification;
use App\OfferMessage;

class OfferController extends Controller
{
    public function store(Request $request)
    {
      $offer = Offer::create([
        'creator_id' => auth()->user()->id,
        'recipient_id' => request('lister_id'),
        'status' => "Open"
      ]);

      $offer_item = OfferItems::create([
        'offer_id' => $offer->id,
        'item_id' => request('item_id'),
        'quantity' => request('quantity'),
        'price' => request('price'),
        'currency' => request('currency')
      ]);

      NewOfferNotification::dispatch($request->lister_id);

      return response()->json("success");
    }

    //View a specific offer
    public function show(Offer $offer){
      $offer_item = OfferItems::where('offer_id', $offer->id)->first();
      $offer_messages = OfferMessage::where('offer_id', $offer->id)->get();

      if( ($offer->creator_id != auth()->user()->id) AND ($offer->recipient_id != auth()->user()->id) )
      {
        return redirect('/');
      }

      return view('offer.show', compact('offer', 'offer_item', 'offer_messages'));
    }


    public function index()
    {
      $received_offers = Offer::SenderItem()->where('creator_id', '!=', auth()->user()->id)->get();
      $sent_offers = Offer::RecipientItem()->where('creator_id', auth()->user()->id)->get();
      return view('offer.index', compact('received_offers', 'sent_offers'));
    }



    public function sendMessage(Request $request){
      $message = OfferMessage::create([ 'offer_id' => $request->offer_id, 'username' => $request->username, 'message' => $request->message ]);
      NewMessage::dispatch($request->offer_id, $request->username, $request->message);
    }


}
