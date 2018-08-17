<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ItemUser;

class HomeController extends Controller
{
    public function index()
    {
      //Get Most recently updated listings
      $new_listings = ItemUser::ItemUser()->orderBy('updated_at', 'desc')->get();
      return view('home.index', compact('new_listings'));
    }
}
