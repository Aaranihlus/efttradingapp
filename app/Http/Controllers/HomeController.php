<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class HomeController extends Controller
{
    public function index()
    {
        //$categories = Item::all()->unique('main_category');
        //$sub_categories = Item::all()->unique('sub_category');
        return view('home.index');
    }
}
