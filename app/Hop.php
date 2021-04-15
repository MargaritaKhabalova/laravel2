<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hop extends Model
{
   public $timestamps=false;
   public $table = "hope";
    protected $fillable=
    [
    	'name', 'quantity', 'price'
    ]; 
}
