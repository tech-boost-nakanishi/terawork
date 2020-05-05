<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplyController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function index()
    {
    	return view('apply.dashboard');
    }
}
