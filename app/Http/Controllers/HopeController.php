<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hop;

class HopeController extends Controller
{
    public function getHopes()
    {
    	$hope = Hop::get();

    	return response()->json($hope);
    }
    public function addHopes(Request $req)
    {
    	$hope = new Hop();

    	$hope->name = $req->name;
    	$hope->quantity = $req->quantity;
    	$hope->price = $req->price;
    	

    	$s = $hope->save();

    	if($s)
    		return response()->json('красаучик, товар успешно добавлен');
    		return response()->json('чтоп сто? ты шо дурак? Товар нормалльно добавить не можешь?');

    }
	public function deleteHopes(Request $req)
	{
		$hope = Hop::where("name", $req->name)->first();
        $hope->delete();
        return response()->json("Товар уничтожен");
  	}

}
