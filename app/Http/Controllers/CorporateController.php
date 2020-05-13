<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class CorporateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:corporate');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$recruits = Auth::guard('corporate')->user()->recruits()->orderBy('created_at', 'desc')->paginate(10);
        return view('recruit.dashboard', ['recruits' => $recruits]);
    }

    public function logout()
    {
    	Auth::guard('corporate')->logout();
    	return redirect('/')->with('logout', 'ログアウトしました。');
    }
}