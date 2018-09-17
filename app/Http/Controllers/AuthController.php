<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{

  public function register(){
    return view('auth.register');
  }

  public function store(Request $request){

    $this->validate(request(), [
      'username' => 'required',
      'email' => 'required|email',
      'password' => 'required|confirmed'
    ]);

    $user = User::create([
      'username' => request('username'),
      'email' => request('email'),
      'password' => bcrypt(request('password')),
      'discord_id' => request('discord_id'),
      'profile_picture' => "hello"
    ]);

    auth()->login($user);

    return redirect('/');
  }


  public function login(){
    return view('auth.login');
  }


  public function loginuser(){
    if(auth()->attempt(request(['email', 'password']))){
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
