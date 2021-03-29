<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class MessageController extends Controller
{
    public function list(){
    	if(Auth::guard('user')->check()){
    		$user = Auth::guard('user')->user();
    		$applies = $user->applies()->orderBy('created_at', 'desc')->paginate(10);
    		return view('apply.messagelist', ['applies' => $applies]);
    	}
    }
}
