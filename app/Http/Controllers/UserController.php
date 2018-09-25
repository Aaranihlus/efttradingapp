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
    $user = User::where('id', auth()->user()->id)->first();

    $scam_reports = ScamReport::where('user_id', $user->id)->count();
    $user_rep_pos = UserReputation::where('user_id', $user->id)->where('type', 'positive')->count();
    $user_rep_neg = UserReputation::where('user_id', $user->id)->where('type', 'negative')->count();
    $user_total_rep = ($user_rep_pos - $user_rep_neg);

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

    return view('profile.user', compact('user', 'scam_reports', 'user_total_rep', 'completed_trades', 'completed_trades_count'));
  }


  public function showProfile($username){
    $user = User::where('username', $username)->first();
    $sale_listings = UserSelling::ItemUser()->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    $buy_listings = UserBuying::ItemUser()->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

    $scam_reports = ScamReport::where('user_id', $user->id)->count();
    $user_rep_pos = UserReputation::where('user_id', $user->id)->where('type', 'positive')->count();
    $user_rep_neg = UserReputation::where('user_id', $user->id)->where('type', 'negative')->count();
    $user_total_rep = ($user_rep_pos - $user_rep_neg);

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

    return view('profile.show', compact('sale_listings', 'buy_listings', 'user', 'scam_reports', 'user_total_rep', 'completed_trades', 'completed_trades_count'));
  }


  public function UserSellingItem($item){
    return UserSelling::where('item_id', $item)->where('user_id', auth()->user()->id)->get();
  }


  public function UserBuyingItem($item){
    return UserBuying::where('item_id', $item)->where('user_id', auth()->user()->id)->get();
  }


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


}
