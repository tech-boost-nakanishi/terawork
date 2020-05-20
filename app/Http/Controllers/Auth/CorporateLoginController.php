<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class CorporateLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:corporate')->except('logout');
    }

    public function showLoginForm()
    {
    	Auth::guard('user')->logout();
      	return view('auth.corporate_login');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('corporate')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location

        return redirect()->route('corporate.dashboard')->with('login', 'ログインしました。');
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
    	Auth::guard('corporate')->logout();
    	return redirect('/')->with('logout', 'ログアウトしました。');
    }
}