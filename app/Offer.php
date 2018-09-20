<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
  protected $fillable = ['creator_id', 'recipient_id', 'status'];

  public function item()
  {
    return $this->hasManyThrough( 'App\Item', 'App\OfferItems',  'offer_id', 'id',  'id', 'item_id');
  }


  public function offer_info()
  {
    return $this->hasOne('App\OfferItems');
  }



  public function sender()
  {
    return $this->belongsTo('App\User', 'creator_id');
  }

  public function recipient()
  {
    return $this->belongsTo('App\User', 'recipient_id');
  }



  public function scopeRecipientItem($query)
  {

    return $query->with('recipient', 'item', 'offer_info');
  }

  public function scopeSenderItem($query)
  {
    return $query->with('sender', 'item', 'offer_info');
  }



  public function scopeRecipientSender($query)
  {
    return $query->with('recipient', 'sender');
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
