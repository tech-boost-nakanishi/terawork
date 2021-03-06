<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        Auth::guard('corporate')->logout();

        if(Auth::guard('user')->user()->email_verified_at !== null){
            return $this->authenticated($request, $this->guard('user')->user())
                ?: redirect('/dashboard')->with('login', 'ログインしました。');
        }else{
            $this->guard('user')->logout($this->guard()->user());
            return view('auth.register_emailcheck_success');
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $pUser = Socialite::driver('google')->stateless()->user();
        
        $user = User::where('email', $pUser->email)->first();
        
        if ($user == null) {
            $user = $this->createUser($pUser);
            Auth::login($user);
            return redirect('/dashboard')->with('register', '登録ありがとうございます。');
        }
        
        Auth::login($user, true);
        return redirect('/dashboard')->with('login', 'ログインしました。');
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        $socialUser = Socialite::driver('github')->stateless()->user();
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user == null) {
            $user = User::create([
                'name' => $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => \Hash::make(uniqid()),
            ]);
            Auth::login($user);
            return redirect('/dashboard')->with('register', '登録ありがとうございます。');
        }

        Auth::login($user);
        return redirect('/dashboard')->with('login', 'ログインしました。');
    }

    public function createUser($pUser)
    {
        $user = User::create([
            'name'     => $pUser->name,
            'email'    => $pUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/')->with('logout', 'ログアウトしました。');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/';
}
