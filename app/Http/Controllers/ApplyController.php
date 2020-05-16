<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Favorite;

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
}
