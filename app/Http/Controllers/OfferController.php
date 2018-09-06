<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\OfferItems;

class OfferController extends Controller
{
    public function store(Request $request)
    {
      $offer = Offer::create([
        'creator_id' => auth()->user()->id,
        'recipient_id' => request('lister_id'),
        'status' => "Offer Sent"
      ]);

      $offer_item = OfferItems::create([
        'offer_id' => $offer->id,
        'item_id' => request('item_id'),
        'quantity' => request('quantity'),
        'price' => request('price'),
        'currency' => request('currency')
      ]);
    }

    //View a specific offer
    public function show(Offer $offer)
    {
      dd($offer);
    }


}
