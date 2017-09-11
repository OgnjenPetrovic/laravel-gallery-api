<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;

class RegisterController extends Controller
{
    public function register(Request $request) {

    	$validation = Validator::make($request->all(), [
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'email' => 'required|email|unique:users',
    		'password' => 'required|min:8|confirmed|regex:/^\D*(?:\d\D*){1,}$/',
    	]);

    	if ($validation->fails()) {
             return $validation->errors();
        }

        return User::create(request()->all());
    }
}
