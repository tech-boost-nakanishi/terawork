<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $email_verify_token = Hash::make(str_random(40));
        $email_verify_token = str_replace('/', '.', $email_verify_token);
        $user = new User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->email_verify_token = $email_verify_token;
        $user->save();

        $this->guard('user')->logout($user);

        Mail::to($user->email)
        ->send(new RegisterMail(
            $user = $user,
        ));

        return view('auth.register_emailcheck_success');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[ぁ-んァ-ヶー一-龠]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function maincheck($email, $token)
    {
        $user = User::where('email', $email)->where('email_verify_token', $token)->first();
        if($user !== null){
            $user->email_verified_at = Carbon::now();
            $user->save();
            $this->guard('user')->login($user);
            return redirect()->action('ApplyController@index')->with('register', '登録ありがとうございます。');
        }else{
            abort(404);
        }
    }
}
