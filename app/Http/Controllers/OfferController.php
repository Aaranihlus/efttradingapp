<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\OfferItems;
use App\Item;
use App\Events\NewMessage;
use App\Events\NewOfferNotification;
use App\OfferMessage;
use App\UserReputation;

class OfferController extends Controller
{
    public function store(Request $request){
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

      if( ($offer->creator_id != auth()->user()->id) AND ($offer->recipient_id != auth()->user()->id) ){
        return redirect('/');
      }

      $offer_item = OfferItems::where('offer_id', $offer->id)->first();
      $offer_messages = OfferMessage::where('offer_id', $offer->id)->get();

      return view('offer.show', compact('offer', 'offer_item', 'offer_messages'));
    }



    public function index(){
      $received_offers = Offer::SenderItem()->where('creator_id', '!=', auth()->user()->id)->where('status', 'Open')->get();
      $sent_offers = Offer::RecipientItem()->where('creator_id', auth()->user()->id)->where('status', 'Open')->get();

      $completed_offers = Offer::with('reviews')->where(function($query){
        $query->where('creator_id', auth()->user()->id)
        ->orWhere('recipient_id', auth()->user()->id);
        })->where('status', 'Complete')->get();

      //Check to see if the user can comment on this offer
      foreach($completed_offers as $offer){
        $offer->canComment = true;
        foreach($offer->reviews as $review){
          //If the reviewer_id of any of the reviews equals this user id, they have already left a review and cannot review that offer again
          if($review->reviewer_id == auth()->user()->id){
            $offer->canComment = false;
          }
        }
      }

      return view('offer.index', compact('received_offers', 'sent_offers', 'completed_offers'));
    }

    public function closeOffer(Request $request){
      $offer = Offer::find($request->offer_id);
      $offer->status = 'Closed';
      $offer->save();
      NewMessage::dispatch($request->offer_id, $request->username, "This Trade has been marked as complete");
      return response()->json("success");
    }


    public function completeOffer(Request $request){
      $offer = Offer::find($request->offer_id);
      $offer->status = 'Complete';
      $offer->save();
      NewMessage::dispatch($request->offer_id, $request->username, "This Trade has been cancelled");
      return response()->json("success");
    }

    public function reviewOffer(Request $request){
      $review = UserReputation::create([ 'user_id' => $request->user_id,
                                         'type' => $request->type,
                                         'reviewer_id' => $request->reviewer_id,
                                         'comment' => $request->comment,
                                         'offer_id' => $request->offer_id
                                       ]);

      return response()->json("success");
    }





    public function sendMessage(Request $request){
      $message = OfferMessage::create([ 'offer_id' => $request->offer_id, 'username' => $request->username, 'message' => $request->message ]);
      NewMessage::dispatch($request->offer_id, $request->username, $request->message);
    }


}
