<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User')->using('App\UserSelling');
  }

  public function offer_info()
  {
    return $this->belongsTo('App\OfferItems');
  }

  public function offer()
  {
    return $this->belongsTo('App\Offer');
  }


}
