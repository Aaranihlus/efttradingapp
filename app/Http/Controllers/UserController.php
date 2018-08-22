<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserBuying;
use App\UserSelling;

class UserController extends Controller
{
  public function myProfile()
  {
    return view('profile.user');
  }


  public function showProfile($username)
  {
    $sale_listings = UserSelling::ItemUser()->orderBy('created_at', 'desc')->limit(10)->get();
    $buy_listings = UserBuying::ItemUser()->orderBy('created_at', 'desc')->limit(10)->get();
    return view('profile.show', compact('sale_listings', 'buy_listings'));
  }


  public function UserSellingItem($item)
  {
    return UserSelling::where('item_id', $item)->where('user_id', auth()->user()->id)->get();
  }


  public function UserBuyingItem($item)
  {
    return UserBuying::where('item_id', $item)->where('user_id', auth()->user()->id)->get();
  }


  public function UpdateBuying(Request $request)
  {
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

  public function UpdateSelling(Request $request)
  {
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
