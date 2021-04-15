<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

   public $timestamps=false;
   public $table = "tea";
   protected $fillable = 
    [
        'name', 'last_name', 'age',  'phone_number', 'password', 'api_token'
    ];
            protected $rqe =
    [
            'password', 'phone_number'
    ];


}