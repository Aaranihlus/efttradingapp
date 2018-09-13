<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferMessage extends Model
{
  protected $table = 'offer_messages';
  protected $fillable = ['offer_id', 'username', 'message'];

  public function offer()
  {
    return $this->belongsTo('App\Offer');
  }


}
