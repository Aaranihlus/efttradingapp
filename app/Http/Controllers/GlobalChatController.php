<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GlobalMessage;
use App\Events\NewGlobalMessage;

class GlobalChatController extends Controller
{

  //Create a new global chat message
  public function store(Request $request)
  {
    $message = GlobalMessage::create([ 'username' => $request->username, 'message' => $request->message ]);
    NewGlobalMessage::dispatch( $request->username, $request->message, $message->created_at );
  }

}
