<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    public function getUsers()
    {
        $user = User::get();

        return response()->json($user);
    }
   public function addUsers(Request $hme)
    {
        $user = new User();

        $user->name = $hme->name;
        $user->last_name = $hme->last_name;
        $user->age = $hme->age;

        $dap = $user->save();
        if($dap)
        return "ALL OK";
    	return "ALL NOT OK";
    }

    public function updateUsers(Request $hme)
    {
        $user = User::where("id", $hme->id)->first();

        $user->name = $hme->name;
        $user->last_name = $hme->last_name;
        $user->age = $hme->age;

        $dap = $user->save();

        return response()->json($user);
    	}
	public function registerUsers(Request $req)
	{
        $label = false;
        $res ="";
        if($req->name == null)
        {
            $label = true;
            $res .='Не заполнено поле name';
        }
        if($req->last_name == null)
        {
            $label = true;
            $res .='Не заполнено поле last_name';
        }
        if($req->age == null)
        {
            $label = true;
            $res .='Не заполнено поле age';
        }

        if($req->phone_number == null)
        {
            $label = true;
            $res .='Не заполнено поле phone_number';
        }
        if($req->password == null)
        {
            $label = true;
            $res .='Не заполнено поле password';
        }
        if($label ==false)
        {
            $user = new User();
            $user-> create($req->all());
            $res = 'Пользователь успешно зарегестрирован';
        }

            return response()->json($res);
    	}

	public function signUsers(Request $req)
    {
    	$user= User::where('phone_number', $req->phone_number)->first();

        if(!$user)
    		return response()->json('Введен неверный логин');
            
        if($req->password != $user->password)
			return response()->json('Введен неверный пароль');
                
        return response()->json('Пользователь успешно авторизован');
    }
   public function registerUser(Request $req)
    {
        $valid = Validator::make($req->all(),
        [
        'name' => 'required',
        'last_name' => 'required',
        'age' => 'required',
        'phone_number' => 'required',
        'password' => 'required',
        ]);

        if ($valid->fails())
            return response()->json($valid->errors());

        $user = User::create($req->all());
        return response()->json('А ты хорош');
    }
        

       
        public function loginUsers(Request $req) 
    	{
        $valid = Validator::make($req->all(), 
        	[
            'phone_number' => 'required',
            'password' => 'required',
        	]);

        if ($valid->fails()) {
            return response()->json($valid->errors());
        }

        if($user = User::where('phone_number', $req->phone_number)->first())
        {
            if ($req->password == $user->password)
            {
                $user->api_token=str_random(50);
                $user->save();
                return response()->json('Авторизацияпрошла успешно, api_token:'. $user->api_token);
            }
        }
                return response()->json('Логин или пароль введены неверно, api_token:'. $user->api_token);
    }

        
        public function logoutUsers(Request $req)
        {
            $user = User::where("api_token",$req->api_token)->first();

            if($user)
            {
                $user->api_token = null;
                $user->save();
                return response()->json('Разлогирование прошло успешно');
            }
        }
}