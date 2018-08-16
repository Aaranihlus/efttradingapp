<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    //Returns all items
    public function AllItems()
    {
      return Item::all();
    }

    //Returns all items within the specified sub category
    public function CategoryItems($sub_category)
    {
      return Item::all()->where('sub_category', $sub_category);
    }

    //Returns all sub categories within the specified main category
    public function SubCategoriesByMainCategory($main_category)
    {
      return Item::distinct('sub_category')->where('main_category', $main_category)->pluck('sub_category');
    }

    //Returns all main category names
    public function MainCategories()
    {
       return Item::select('main_category')->distinct()->pluck('main_category');
    }

    //Returns all sub category names
    public function SubCategories()
    {
      return Item::distinct('sub_category')->pluck('sub_category');
    }

}
