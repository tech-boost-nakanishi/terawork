<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Language;

class RecruitController extends Controller
{
    public function top()
    {
    	return view('top');
    }   

    public function add()
    {
    	$languages = Language::all();
    	return view('recruit.create', ['languages' => $languages]);
    }
}
