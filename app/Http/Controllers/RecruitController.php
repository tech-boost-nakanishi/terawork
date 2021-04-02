<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        $PerPage = 6;
        $from = 0;
        $to = 0;
    	$recruit = Recruit::where('status', '募集中')->orderby('created_at', 'desc');

        if($request->input('page', 1) * $PerPage - $PerPage + 1 < count($recruit->get())){
            $from = $request->input('page', 1) * $PerPage - $PerPage + 1;
        }else{
            $from = count($recruit->get());
        }

        if($from + $PerPage - 1 < count($recruit->get())){
            $to = $from + $PerPage - 1;
        }else{
            $to = count($recruit->get());
        }
        $recruits = $recruit->paginate($PerPage);
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

        $recruitdata = \DB::table('recruits')
                        ->join('recruit_languages', 'recruits.id' , '=', 'recruit_languages.recruit_id')
                        ->join('languages', 'language_id', '=', 'languages.id')
                        ->orderBy('recruits.created_at', 'DESC')
                        ->get();

    	return view('recruit.index', ['recruit' => $recruit, 'recruitdata' => $recruitdata]);
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
            $PerPage = 6;   //1ページあたりの件数
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
    	Gate::authorize('update-recruit', $recruit);
    	return view('recruit.edit', ['recruit' => $recruit]);
    }

    public function update($id, Request $request)
    {
    	$this->validate($request, Recruit::$rules);

    	$recruit = Recruit::findOrFail($id);
        Gate::authorize('update-recruit', $recruit);
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

    	return redirect()->action('RecruitController@edit', ['id' => $id])->with('recruitupdated', '求人を更新しました。');
    }

    public function appliedlist($id)
    {
        $recruit = Recruit::findOrFail($id);
        $applies = $recruit->applies()->paginate(10);
        return view('recruit.appliedlist', ['applies' => $applies, 'recruit' => $recruit]);
    }

    public function profile($id)
    {
    	$corporate = Corporate::findOrFail($id);
    	return view('recruit.profile', ['corporate' => $corporate]);
    }

    public function profileedit($id)
    {
    	$corporate = Corporate::findOrFail($id);
        Gate::authorize('corporateprofile', $id, Auth::guard('corporate')->user()->id);
    	return view('recruit.profile_edit', ['corporate' => $corporate]);
    }

    public function profileupdate($id, Request $request)
    {
    	$this->validate($request, Corporate::rules($request->all()));

    	$corporate = Corporate::findOrFail($id);
        Gate::authorize('corporateprofile', $id, Auth::guard('corporate')->user()->id);
    	$form = $request->all();

    	$corporate->corporate_name = $request->corporate_name;
    	$corporate->contact_name = $request->contact_name;
    	$corporate->email = $request->email;

    	unset($form['_token']);
		$corporate->save();

		return redirect()->action('RecruitController@profileedit', ['id' => $id])->with('profileedited', 'プロフィールを更新しました。');
    }

    public function corporate_list()
    {
        $corporates = Recruit::where('status', '募集中')->groupBy('corporate_id')->paginate(50,['corporate_id']);
        return view('recruit.corporate_list', ['corporates' => $corporates]);
    }

    public function delete($id, Request $request)
    {
    	$recruit = Recruit::findOrFail($id);
        Gate::authorize('update-recruit', $recruit);
    	$recruit->delete();
    	return redirect()->route('corporate.dashboard')->with('recruitdelete', '求人を削除しました。');
    }

    public function pre_cancel($id)
    {
        $corporate_id = $id;
        Gate::authorize('corporatecancel', $id, Auth::guard('corporate')->user()->id);
        return view('recruit.cancel', ['corporate_id' => $corporate_id]);
    }

    public function cancel($id)
    {
        $corporate = Corporate::findOrFail($id);
        Gate::authorize('corporatecancel', $id, Auth::guard('corporate')->user()->id);
        $corporate->delete();
        return redirect('/')->with('corporatecancel', 'ご利用ありがとうございました。');
    }
}
