<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplyConfirmMail;
use App\Mail\ApplyMail;

use Auth;

use App\User;
use App\Favorite;
use App\Apply;

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

    public function profile($id)
    {
    	$user = User::findOrFail($id);
    	return view('apply.profile', ['user' => $user]);
    }

    public function favorite($id)
    {
    	$favrec = Favorite::where('user_id', Auth::guard('user')->user()->id)->where('recruit_id', $id)->first();

    	if($favrec === null){
    		$favorite = new Favorite;
    		$favorite->user_id = Auth::guard('user')->user()->id;
    		$favorite->recruit_id = $id;
    		$favorite->save();
    		return redirect()->action('RecruitController@show', ['id' => $id])->with('favadded', 'お気に入りに登録しました。');
    	}else{
    		return redirect()->action('RecruitController@show', ['id' => $id])->with('favexists', 'お気に入りに登録済みです。');
    	}
    }

    public function pre_apply($id)
    {
    	$recid = $id;
    	return view('apply.pre_apply', ['recid' => $recid]);
    }

    public function apply($id, Request $request)
    {
    	$this->validate($request, Apply::$rules);

    	$applyuser = Apply::where('user_id', Auth::guard('user')->user()->id)->where('recruit_id', $id)->first();

    	if($applyuser === null){
    		$apply = new Apply;
    		$apply->user_id = Auth::guard('user')->user()->id;
    		$apply->recruit_id = $id;
    		$apply->save();

    		$recruit = $apply->recruit()->first();
    		$corporate = $recruit->corporate()->first();

    		Mail::to($request->email)->send(new ApplyConfirmMail(
    			$name = Auth::guard('user')->user()->name,
    			$corporate_email = $corporate->email,
    		));

    		Mail::to($corporate->email)->send(new ApplyMail(
    			$username = $request->username,
    			$phonetic = $request->phonetic,
    			$birth_yaer = $request->birth_year,
    			$birth_month = $request->birth_month,
    			$birth_day = $request->birth_day,
    			$age = $request->age,
    			$live_pref_name = $request->live_pref_name,
    			$email = $request->email,
    			$phone = $request->phone,
    			$rectitle = $recruit->title,
    			$corporate_name = $corporate->corporate_name,
    			$contact_name = $corporate->contact_name,
    		));

    		return redirect()->action('ApplyController@pre_apply', ['id' => $id])->with('applysuccess', '応募が完了しました。');
    	}else{
    		return redirect()->action('ApplyController@pre_apply', ['id' => $id])->with('applied', '応募済みです。');
    	}
    }
}
