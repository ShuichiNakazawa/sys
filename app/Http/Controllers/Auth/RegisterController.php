<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    
    protected $redirectTo = RouteServiceProvider::HOME;


    /*
    // Add for login by login_id 20210909 START
    protected function authenticated(Request $request, $user)
    {

        if(session()->has('redirect.url') ) {
            return redirect( session()->get( 'redirect.url' ) );
       }

        return redirect('home2');
    }
    // Add for login by login_id 20210909 END
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if ( \request()->get( 'redirect_to' ) ) {
            session()->put( 'redirect.url', \request()->get( 'redirect_to' ) );
        }
        $this->middleware('guest');
        session()->put('backUrl', URL::previous());
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
            'name' => ['required', 'string', 'max:255'],

            'email' => ['string', 'email', 'max:255', 'unique:users'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            // Add for longin by login_id 20210909
            'login_id'  =>  ['required', 'string', 'alpha_dash', 'min:4', 'max:255', 'unique:users'],
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
        /**
         * 利用システムごとにアカウント作成を変更する修正
        */
        //$sight_key = $request->session()->get('sight_key');


        return User::create([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),

            // Add for longin by login_id 20210909
            'login_id' => $data['login_id'],
        ]);

    }

    public function redirectTo()
    {
        /*
        if(){
            redirect();
        }
        */
        return session()->get('backUrl', URL::previous()) ? session()->get('backUrl', URL::previous()) : $this->redirectTo;
    }
}
