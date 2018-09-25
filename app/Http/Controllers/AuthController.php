<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
  public function store(Request $request){

    $this->validate($request, [
      'username' => 'required',
      'password' => 'required|confirmed',
      'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $path = $request->file('profile_picture')->store('profile_pictures');

    $user = User::create([
      'username' => $request->username,
      'password' => bcrypt($request->password),
      'discord_id' => $request->discord_id,
      'profile_picture' => $path
    ]);


    auth()->login($user);

    return redirect('/');
  }

  public function register(){
    return view('auth.register');
  }


  public function login(){
    return view('auth.login');
  }


  public function loginuser(){
    if(auth()->attempt(request(['username', 'password']))){
      return redirect('/');
    } else {
      return back()->withErrors(['message' => "Please check your credentials and try again"]);
    }
  }


  public function logout(){
    auth()->logout();
    return redirect('/');
  }
}
