<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\ItemUser;

class ItemUserController extends Controller
{

  public function UpdateItem(Request $request)
  {

  /*  $itemuser = ItemUser::where('user_id', auth()->user()->id)->where('item_id', request('item_id'))->first();

    if(!$itemuser)
    {
      $itemuser = new ItemUser;
      $itemuser->item_id = request('item_id');
      $itemuser->user_id = auth()->user()->id;
      $itemuser->selling_currency = request('sellingcurrency');
      $itemuser->selling_price = request('sellingprice');
      $itemuser->selling_quantity = request('sellingqty');
      $itemuser->buying_currency = request('buyingcurrency');
      $itemuser->buying_price = request('buyingprice');
      $itemuser->buying_quantity = request('buyingqty');
      $itemuser->save();
    }
    else
    {
      $itemuser->item_id = request('item_id');
      $itemuser->user_id = auth()->user()->id;
      $itemuser->selling_currency = request('sellingcurrency');
      $itemuser->selling_price = request('sellingprice');
      $itemuser->selling_quantity = request('sellingqty');
      $itemuser->buying_currency = request('buyingcurrency');
      $itemuser->buying_price = request('buyingprice');
      $itemuser->buying_quantity = request('buyingqty');
      $itemuser->save();
    }*/

    //DB::select("SELECT * FROM item_user WHERE user_id = " . auth()->user()->id . " AND item_id = " . $item);


      $itemuser = ItemUser::updateOrCreate([
        'item_id' => request('item_id'),
        'user_id' => auth()->user()->id
      ],[
        'selling_currency' => request('sellingcurrency'),
        'selling_price' => request('sellingprice'),
        'selling_quantity' => request('sellingqty'),
        'buying_currency' => request('buyingcurrency'),
        'buying_price' => request('buyingprice'),
        'buying_quantity' => request('buyingqty')
      ]);

      if(!$itemuser){
        return response()->json("false");
      }else{
        return response()->json("true");
      }


  }
}
