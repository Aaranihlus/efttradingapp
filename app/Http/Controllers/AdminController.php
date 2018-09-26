<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


  public function home()
  {
    if(auth()->user()->admin){
      return view('admin.index');
    } else {
      return redirect('/');
    }
  }


}
