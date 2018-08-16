<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

  //Show the users profile
  public function myProfile()
  {
    return view('profile.user');
  }

  //Show another users profile
  public function showProfile(User $user)
  {
    return view('profile.show', compact('user'));
  }

  public function userItems($item)
  {
    return DB::select("SELECT * FROM item_user WHERE user_id = " . auth()->user()->id . " AND item_id = " . $item);
  }


}
