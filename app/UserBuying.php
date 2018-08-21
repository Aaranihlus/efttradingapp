<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBuying extends Model
{
  protected $table = 'user_buying';
  protected $fillable = ['item_id', 'user_id', 'quantity', 'price', 'currency'];
  public $incrementing = false;

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function item()
  {
    return $this->belongsTo('App\Item');
  }

  public function scopeItemUser($query)
  {
    return $query->with('user', 'item');
  }


}
