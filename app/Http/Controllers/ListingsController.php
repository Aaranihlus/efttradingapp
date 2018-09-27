<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserBuying;
use App\UserSelling;

class ListingsController extends Controller
{
    public function all()
    {

      $sale_listings = UserSelling::ItemUser()->where('quantity', '>', '0')->orderBy('created_at', 'desc')->get();
      $buy_listings = UserBuying::ItemUser()->where('quantity', '>', '0')->orderBy('created_at', 'desc')->get();

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

      return view('listings.all', compact('all_listings'));

    }

    public function buying()
    {
      $buy_listings = UserBuying::ItemUser()->orderBy('created_at', 'desc')->get();
      return view('listings.buying', compact('buy_listings'));
    }

    public function selling()
    {
      $sale_listings = UserSelling::ItemUser()->orderBy('created_at', 'desc')->get();
      return view('listings.selling', compact('sale_listings'));
    }
}
