<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Auth;

class CorporateLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:corporate')->except('logout');
    }

    public function showLoginForm()
    {
      	return view('auth.corporate_login');
    }

    public function login(Request $request)
    {

      $validator = Validator::make($request->all(), [
      		'email'   => 'required|string',
        	'password' => 'required|string'
      ]);

      // Attempt to log the user in
      if (Auth::guard('corporate')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
      	if(Auth::guard('corporate')->user()->email_verified_at !== null){
            return redirect()->route('corporate.dashboard')->with('login', 'ログインしました。');
        }else{
            Auth::guard('corporate')->logout();
            return view('auth.register_emailcheck_success');
        }
      }
      // if unsuccessful, then redirect back to the login with the form data
      $validator->errors()->add('email', trans('auth.failed'));
	  throw new ValidationException($validator);
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
    	Auth::guard('corporate')->logout();
    	return redirect('/')->with('logout', 'ログアウトしました。');
    }
}