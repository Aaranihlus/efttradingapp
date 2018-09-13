<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferItems extends Model
{
    protected $table = 'offer_items';
    protected $fillable = ['offer_id', 'item_id', 'quantity', 'price', 'currency'];


    public function offer()
    {
      return $this->belongsTo('App\Offer');
    }

    public function item()
    {
      return $this->belongsTo('App\Item');
    }

    public function scopeItemOffer($query)
    {
      return $query->with('item', 'offer');
    }





}
