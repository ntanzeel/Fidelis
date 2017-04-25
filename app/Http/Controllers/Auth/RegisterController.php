<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Validator;
use Carbon\Carbon;

class RegisterController extends Controller {

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

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('auth.register.index');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        Validator::extend('age', function ($attribute, $value, $parameters) {
            return Carbon::now()->diff(new Carbon($value))->y >= 13;
        }, 'You must be at least 13 years old to register.');

        return Validator::make($data, [
            'name'       => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users',
            'username'   => 'required|max:255:unique:users',
            'password'   => 'required|min:6|confirmed',
            'dob'        => 'required|date|age',
            'read_terms' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'username' => strtolower($data['username']),
            'password' => bcrypt($data['password']),
            'dob'      => $data['dob'],
        ]);
    }
}
