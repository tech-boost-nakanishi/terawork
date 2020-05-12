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
    	$recruits = Recruit::orderby('created_at', 'desc')->paginate(12);
    	return view('top', ['recruits' => $recruits]);
    }   

    public function add()
    {
    	return view('recruit.create');
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

    public function edit($id)
    {
    	$recruit = Recruit::findOrFail($id);
    	if($recruit->corporate_id != Auth::guard('corporate')->user()->id){
    		abort(404);
    	}

    	return view('recruit.edit', ['recruit' => $recruit]);
    }

    public function update(Request $request)
    {
    	$this->validate($request, Recruit::$rules);

    	$recruit = Recruit::find($request->id);
    	$form = $request->all();

    	$recruit->corporate_id = Auth::guard('corporate')->user()->id;
    	$recruit->title = $request->title;
    	$recruit->monthly_income = $request->monthly_income;
    	$recruit->pref_name = $request->pref_name;
    	$recruit->body = $request->body;
    	$recruit->status = $request->status;
    	$recruit->save();

    	foreach ($recruit->recruitlanguages()->get() as $key => $value) {
    		$value->delete();
    	}

    	foreach ($request->languages as $key => $value) {
    		$reclang = new RecruitLanguage;
    		$reclang->recruit_id = $recruit->id;
    		$reclang->language_id = $value;
    		$reclang->save();
    	}

    	unset($form['_token']);

    	return redirect()->route('recruit.edit', ['id' => $request->id])->with('recruitupdated', '求人を更新しました。');
    }
}
