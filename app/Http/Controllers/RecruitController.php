<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use App\Language;
use App\Recruit;
use App\RecruitLanguage;
use App\ViewHistory;
use App\Corporate;

class RecruitController extends Controller
{
    public function top(Request $request)
    {
        $PerPage = 12;
        $from = 0;
        $to = 0;
    	$recruits = Recruit::where('status', '募集中')->orderby('created_at', 'desc')->paginate($PerPage);

        if($request->input('page', 1) * $PerPage - $PerPage + 1 < count($recruits)){
            $from = $request->input('page', 1) * $PerPage - $PerPage + 1;
        }else{
            $from = count($recruits);
        }

        if($from + $PerPage - 1 < count($recruits)){
            $to = $from + $PerPage - 1;
        }else{
            $to = count($recruits);
        }
    	return view('top', ['recruits' => $recruits, 'from' => $from, 'to' => $to]);
    }

    public function show($id)
    {
    	$recruit = Recruit::findOrFail($id);

    	if(Auth::guard('user')->check()){
	    	$recview = ViewHistory::where('user_id', Auth::guard('user')->user()->id)->where('recruit_id', $id)->first();
	    	if($recview === null){
		    	$viewhistory = new ViewHistory;
		    	$viewhistory->user_id = Auth::guard('user')->user()->id;
		    	$viewhistory->recruit_id = $id;
		    	$viewhistory->save();
		    }else{
		    	$recview->updated_at = Carbon::now();
		    	$recview->save();
		    }
		}

    	return view('recruit.index', ['recruit' => $recruit]);
    }

    public function languagelist($language, Request $request)
    {
        $result = Recruit::where('status', '募集中')->orderby('created_at', 'desc')->get();
        $recruit = [];
        foreach ($result as $key => $value) {
            if($value->languages()->get()->contains('name', $language)){
                $recruit[] = $value;
            }
        }

        $recruits = [];
        $from = 0;
        $to = 0;
        if(count($recruit) > 0){
            $PerPage = 12;   //1ページあたりの件数
            $displayData = array_chunk($recruit, $PerPage);
            $currentPageNo = $request->input('page', 1);

            $recruits = new LengthAwarePaginator(
                $displayData[$currentPageNo - 1],
                count($recruit),
                $PerPage,
                $currentPageNo,
                array('path' => $request->url())
            );

            if($request->input('page', 1) * $PerPage - $PerPage + 1 < count($recruit)){
                $from = $request->input('page', 1) * $PerPage - $PerPage + 1;
            }else{
                $from = count($recruit);
            }

            if($from + $PerPage - 1 < count($recruit)){
                $to = $from + $PerPage - 1;
            }else{
                $to = count($recruit);
            }
        }
        return view('recruit.languages_list', ['recruits' => $recruits, 'recruit' => $recruit, 'language' => $language, 'from' => $from, 'to' => $to]);
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

    public function profile($id)
    {
    	$corporate = Corporate::findOrFail($id);
    	return view('recruit.profile', ['corporate' => $corporate]);
    }

    public function profileedit($id)
    {
    	$corporate = Corporate::findOrFail($id);
    	if($id != Auth::guard('corporate')->user()->id){
    		abort(404);
    	}
    	return view('recruit.profile_edit', ['corporate' => $corporate]);
    }

    public function profileupdate($id, Request $request)
    {
    	$this->validate($request, Corporate::rules($request->all()));

    	$corporate = Corporate::findOrFail($id);
    	$form = $request->all();

    	$corporate->corporate_name = $request->corporate_name;
    	$corporate->contact_name = $request->contact_name;
    	$corporate->email = $request->email;

    	unset($form['_token']);
		$corporate->save();

		return redirect()->action('RecruitController@profileedit', ['id' => $id])->with('profileedited', 'プロフィールを更新しました。');
    }

    public function delete(Request $request)
    {
    	$recruit = Recruit::find($request->id);

    	if($recruit->corporate_id == Auth::guard('corporate')->user()->id){
    		$recruit->delete();
    		return redirect()->route('corporate.dashboard')->with('recruitdelete', '求人を削除しました。');
    	}else{
    		abort(404);
    	}
    }
}
