<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function selling()
    {
      return $this->hasMany('App\UserSelling')->with('item');
    }

    public function buying()
    {
      return $this->hasMany('App\UserBuying')->with('item');
    }

}
