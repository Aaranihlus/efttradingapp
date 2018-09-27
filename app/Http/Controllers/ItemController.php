<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\UserBuying;
use App\UserSelling;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{
    //Returns all items
    public function AllItems()
    {
      return Item::all();
    }

    //Returns all items within the specified sub category
    public function CategoryItems($sub_category, $main_category)
    {
      return Item::where('sub_category', str_replace(" ", "_", $sub_category))->where('main_category', str_replace(" ", "_", $main_category))->get();
    }

    //Returns all sub categories within the specified main category
    public function SubCategoriesByMainCategory($main_category)
    {
      return Item::distinct('sub_category')->where('main_category', $main_category)->pluck('sub_category');
    }

    //Returns all main category names
    public function MainCategories()
    {
       return Cache::remember('all_main_categories', 60, function (){
         return Item::distinct('main_category')->where('main_category', '!=', "Armband")->pluck('main_category');
       });
    }

    //Returns all sub category names
    public function SubCategories()
    {
      return Cache::remember('all_sub_categories', 60, function (){
        return Item::distinct('sub_category')->pluck('sub_category');
      });
    }

    //Returns item listings for a specific item id
    public function ItemListings($id)
    {
      $sale_listings = UserSelling::ItemUser()->where('item_id', '=', $id)->orderBy('created_at', 'desc')->get();
      $buy_listings = UserBuying::ItemUser()->where('item_id', '=', $id)->orderBy('created_at', 'desc')->get();
      return view('item.show', compact('sale_listings', 'buy_listings'));
    }

}
