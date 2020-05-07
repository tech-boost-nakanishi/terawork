<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Language;
use App\Recruit;
use App\RecruitLanguage;

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

    public function create(Request $request)
    {
    	$this->validate($request, Recruit::$rules);

    	$recruit = new Recruit;
    	$form = $request->all();

    	$recruit->corporate_id = Auth::guard('corporate')->user()->id;
    	$recruit->title = $request->title;
    	$recruit->monthly_income = $request->monthly_income;
    	$recruit->pref_name = $request->pref_name;
    	$recruit->body = $request->body;
    	$recruit->save();

    	foreach ($request->languages as $key => $value) {
    		$reclang = new RecruitLanguage;
    		$reclang->recruit_id = $recruit->id;
    		$reclang->language_id = $value;
    		$reclang->save();
    	}

    	unset($form['_token']);

    	return redirect('/corporate/recruit/create')->with('recruitcreate', '投稿が完了しました。');
    }
}
