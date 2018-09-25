<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScamReport extends Model
{
  protected $table = 'scam_reports';
  protected $fillable = ['user_id'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
