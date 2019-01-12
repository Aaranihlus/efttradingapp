<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\UserBuying;
use App\UserSelling;
use App\Offer;
use App\ScamReport;
use App\UserReputation;

class UserController extends Controller
{

  public function myProfile(){

    if(!isset(auth()->user()->id)){
      return redirect('/register');
    }

    $user = User::where('id', auth()->user()->id)->first();

    $scam_reports = ScamReport::where('user_id', $user->id)->count();
    $user_reps = UserReputation::where('user_id', $user->id)->get();

    $user_rep_pos = 0;
    $user_rep_neg = 0;

    foreach($user_reps as $rep){
      if($rep->type == "positive"){
        $user_rep_pos += 1;
      } else {
        $user_rep_neg += 1;
      }
    }

    $user_total_rep = ($user_rep_pos - $user_rep_neg);

    $sale_listings = UserSelling::ItemUser()->where('user_id', $user->id)->where('quantity', '>', '0')->orderBy('created_at', 'desc')->get();
    $buy_listings = UserBuying::ItemUser()->where('user_id', $user->id)->where('quantity', '>', '0')->orderBy('created_at', 'desc')->get();

    $all_listings = collect();

    foreach ($sale_listings as $sale){
      $sale->type = "sell";
      $all_listings->push($sale);
    }

    foreach ($buy_listings as $buy){
      $buy->type = "buy";
      $all_listings->push($buy);
    }

    $all_listings->sortBy('created_at');

    $completed_trades = Offer::with('reviews', 'reviewer')->where(function($query){
      $query->where('creator_id', auth()->user()->id)
      ->orWhere('recipient_id', auth()->user()->id);
    })->where('status', 'Complete')->get();

    $completed_trades_count = 0;

    foreach($completed_trades as $trade){
      foreach($trade->reviews as $review){
        if($review->reviewer_id != auth()->user()->id){
          $completed_trades_count += 1;
        }
      }
    }

    return view('profile.user', compact('user', 'scam_reports', 'user_total_rep', 'completed_trades', 'completed_trades_count', 'all_listings'));
  }


  public function showProfile($username){

    if(!isset(auth()->user()->id)){
      return redirect('/register');
    }

    $user = User::where('username', $username)->first();
    $sale_listings = UserSelling::ItemUser()->where('user_id', $user->id)->where('quantity', '>', '0')->orderBy('created_at', 'desc')->get();
    $buy_listings = UserBuying::ItemUser()->where('user_id', $user->id)->where('quantity', '>', '0')->orderBy('created_at', 'desc')->get();

    $scam_reports = ScamReport::where('user_id', $user->id)->count();
    $user_rep_pos = UserReputation::where('user_id', $user->id)->where('type', 'positive')->count();
    $user_rep_neg = UserReputation::where('user_id', $user->id)->where('type', 'negative')->count();
    $user_total_rep = ($user_rep_pos - $user_rep_neg);

    $completed_trades = Offer::with('reviews', 'reviewer')->where(function($query) use ($user){
      $query->where('creator_id', $user->id)
      ->orWhere('recipient_id', $user->id);
    })->where('status', 'Complete')->get();

    $completed_trades_count = 0;

    foreach($completed_trades as $trade){
      foreach($trade->reviews as $review){
        if($review->reviewer_id != $user->id){
          $completed_trades_count += 1;
        }
      }
    }

    return view('profile.show', compact('sale_listings', 'buy_listings', 'user', 'scam_reports', 'user_total_rep', 'completed_trades', 'completed_trades_count'));
  }



  public function RemoveListing(Request $request)
  {
    $id = $request->listing_id;
    if($request->type == "sell"){
      $listing = UserSelling::find($id);
    } else {
      $listing = UserBuying::find($id);
    }

    $listing->quantity = 0;
    $listing->save();

    return response()->json("success");
  }


  //Update Selling Listing
  public function UpdateSelling(Request $request){
    $selling = UserSelling::updateOrCreate([
      'item_id' => request('item_id'),
      'user_id' => auth()->user()->id
    ],[
      'price' => request('price'),
      'quantity' => request('quantity'),
      'currency' => request('currency')
    ]);

    if($selling){
      return response()->json("true");
    }else{
      return response()->json("false");
    }
  }

  //Update Buying Listing
  public function UpdateBuying(Request $request){
    $buying = UserBuying::updateOrCreate([
      'item_id' => request('item_id'),
      'user_id' => auth()->user()->id
    ],[
      'price' => request('price'),
      'quantity' => request('quantity'),
      'currency' => request('currency')
    ]);

    if($buying){
      return response()->json("true");
    }else{
      return response()->json("false");
    }
  }


}
