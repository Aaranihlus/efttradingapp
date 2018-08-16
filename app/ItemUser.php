<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemUser extends Model
{
  protected $table = 'item_user';
  protected $fillable = ['item_id', 'user_id', 'selling_currency', 'selling_price', 'selling_quantity', 'buying_currency', 'buying_price', 'buying_quantity'];
  //protected $primaryKey = ['item_id', 'user_id'];
  public $incrementing = false;

  public function user()
  {
    return $this->hasOne('App\User');
  }

  public function item()
  {
    return $this->hasOne('App\Item');
  }

}
