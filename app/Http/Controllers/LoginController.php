<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use Auth; 

class LoginController extends Controller
{
    //
    public function showLoginForm(){
    	return view("loginform");
    }
    public function processLogin(LoginRequest $req){
    	//get credential
		$credential = $req->only("username","password");

		//ask Authenticator to check
		if(Auth::attempt($credential)){
			return redirect("types/1");
		}else{
			return redirect("login")->with("message","Try again!");
		}
    }
    public function logout(){
    	//log you out
		Auth::logout();
		//redirect to login
		return redirect("login");
    }
}
