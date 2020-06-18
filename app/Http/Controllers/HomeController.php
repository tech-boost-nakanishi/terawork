<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/');
    }

    public function showChangePasswordForm() {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request) {
        //現在のパスワードが正しいかを調べる
        if(Auth::guard('user')->check()){
            if(!(Hash::check($request->get('current-password'), Auth::guard('user')->user()->password))) {
                return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
            }
        }else{
            if(!(Hash::check($request->get('current-password'), Auth::guard('corporate')->user()->password))) {
                return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
            }
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        //パスワードのバリデーション。新しいパスワードは6文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //パスワードを変更
        if(Auth::guard('user')->check()){
            $user = Auth::guard('user')->user();
            $user->password = Hash::make($request->get('new-password'));
            $user->save();
        }else{
            $corporate = Auth::guard('corporate')->user();
            $corporate->password = Hash::make($request->get('new-password'));
            $corporate->save();
        }

        return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
    }
}
