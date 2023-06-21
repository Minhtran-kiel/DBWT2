<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class MyAuthController extends Controller{
    public function __construct()
    {
        $this->middleware('web');
    }
    public function login(Request $request){
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));
    
        $user = new User();
        $user = User::query()->where('ab_name', '=', $username)->first();
       
        //check if the user exists and the password matches
        if($user && $user->ab_password == $password){
            $userId = $user->id;
            setcookie('userId', $userId);
            return redirect('newsite');
        }
        else {
            return response()->json(['message' => 'Invalid username or password']);
        }
    }
}