<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\UserBuying;
use App\UserSelling;
use App\Events\UpdateOrderStatus;
use Auth;

class HomeController extends Controller
{
  public function index()
  {
    $buy_listings = UserBuying::ItemUser()->orderBy('created_at', 'desc')->limit(10)->get();
    $sale_listings = UserSelling::ItemUser()->orderBy('created_at', 'desc')->limit(10)->get();

    return view('home.index', compact('buy_listings', 'sale_listings'));
  }
}
