<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalMessage extends Model
{
  protected $table = 'global_chat_messages';
  protected $fillable = [ 'username', 'message' ];
}
