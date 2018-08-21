<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSelling extends Model
{
  protected $table = 'user_selling';
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
