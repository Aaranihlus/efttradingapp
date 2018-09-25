<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReputation extends Model
{
  protected $table = 'user_reputation';
  protected $fillable = ['user_id', 'reviewer_id', 'type', 'offer_id', 'comment'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function reviewer()
  {
    return $this->belongsTo('App\User', 'reviewer_id');
  }




}
