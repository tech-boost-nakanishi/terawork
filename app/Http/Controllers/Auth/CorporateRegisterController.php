<?php

namespace App\Http\Controllers\Auth;

use App\Corporate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Auth;

class CorporateRegisterController extends Controller
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

    public function showRegistrationForm()
    {
    	Auth::guard('user')->logout();
        return view('auth.corporate_register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $corporate = new Corporate;
        $corporate->corporate_name = $request->corporate_name;
        $corporate->contact_name = $request->contact_name;
        $corporate->email = $request->email;
        $corporate->password = Hash::make($request->password);
        $corporate->save();

        Auth::guard('corporate')->login($corporate);

        return redirect('/corporate/dashboard')->with('register', '登録ありがとうございます。');
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
        $this->middleware('guest:corporate');
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
            'corporate_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:corporates'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Corporate
     */
    protected function create(array $data)
    {
        return Corporate::create([
            'corporate_name' => $data['corporate_name'],
            'contact_name' => $data['contact_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
