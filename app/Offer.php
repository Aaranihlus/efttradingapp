<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
  protected $fillable = ['creator_id', 'recipient_id', 'status'];

  public function item()
  {
    return $this->belongsTo('App\Item');
  }

  public function messages()
  {
    return $this->hasMany('App\OfferMessage');
  }

  public function scopeItemMessages($query)
  {
    return $query->with('item', 'messages');
  }

}
