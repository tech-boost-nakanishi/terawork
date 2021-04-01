<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplyConfirmMail;
use App\Mail\ApplyMail;
use Illuminate\Support\Facades\Gate;

use Auth;

use App\User;
use App\Favorite;
use App\Apply;
use App\Message;

class ApplyController extends Controller
{
    public function index()
    {
    	$applyrecs = Auth::guard('user')->user()->applies()->orderby('created_at', 'desc')->take(3)->get();
    	$viewrecs = Auth::guard('user')->user()->viewhistories()->orderby('created_at', 'desc')->take(3)->get();
    	$favrecs = Auth::guard('user')->user()->favorites()->orderby('created_at', 'desc')->take(3)->get();
    	return view('apply.dashboard', ['applyrecs' => $applyrecs, 'viewrecs' => $viewrecs, 'favrecs' => $favrecs]);
    }

    public function applylist($id)
    {
    	$user = User::findOrFail($id);
        Gate::authorize('view', $id, Auth::guard('user')->user()->id);
    	$applylist = $user->applies()->orderby('created_at', 'desc')->paginate(10);
    	return view('apply.applylist', ['applylist' => $applylist, 'user' => $user]);
    }

    public function viewlist($id)
    {
    	$user = User::findOrFail($id);
        Gate::authorize('view', $id, Auth::guard('user')->user()->id);
    	$viewlist = $user->viewhistories()->orderby('created_at', 'desc')->paginate(10);
    	return view('apply.viewlist', ['viewlist' => $viewlist, 'user' => $user]);
    }

    public function favoritelist($id)
    {
    	$user = User::findOrFail($id);
        Gate::authorize('view', $id, Auth::guard('user')->user()->id);
    	$favoritelist = $user->favorites()->orderby('created_at', 'desc')->paginate(10);
    	return view('apply.favoritelist', ['favoritelist' => $favoritelist, 'user' => $user]);
    }

    public function profile($id)
    {
    	$user = User::findOrFail($id);
    	return view('apply.profile', ['user' => $user]);
    }

    public function profileedit($id)
    {
    	$user = User::findOrFail($id);
        Gate::authorize('userprofile', $id, Auth::guard('user')->user()->id);
    	return view('apply.profile_edit', ['user' => $user]);
    }

    public function profileupdate($id, Request $request)
    {
    	$this->validate($request, User::rules($request->all()));

    	$user = User::findOrFail($id);
        Gate::authorize('userprofile', $id, Auth::guard('user')->user()->id);
    	$form = $request->all();

    	if(!empty($request->qualification)){
    		$user->qualification = str_replace('／', '/', $request->qualification);
    	}else{
    		$user->qualification = null;
    	}

    	if(!empty($request->hobby)){
    		$user->hobby = str_replace('／', '/', $request->hobby);
    	}else{
    		$user->hobby = null;
    	}

    	if(!empty($request->introduction)){
    		$user->introduction = $request->introduction;
    	}else{
    		$user->introduction = null;
    	}

    	$user->name = $request->name;
    	$user->email = $request->email;

    	unset($form['_token']);
		$user->save();

		return redirect()->action('ApplyController@profileedit', ['id' => $id])->with('profileedited', 'プロフィールを更新しました。');
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
                $user_id = $apply->user_id,
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

    public function pre_cancel($id)
    {
        $user_id = $id;
        Gate::authorize('usercancel', $id, Auth::guard('user')->user()->id);
        return view('apply.cancel', ['user_id' => $user_id]);
    }

    public function cancel($id)
    {
        $user = User::findOrFail($id);
        Gate::authorize('usercancel', $id, Auth::guard('user')->user()->id);
        $user->delete();
        return redirect('/')->with('usercancel', 'ご利用ありがとうございました。');
    }
}
