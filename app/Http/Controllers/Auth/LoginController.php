<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // Add for login by login_id 20210909 START
    protected function authenticated(Request $request, $user)
    {

        if(session()->has('redirect.url') ) {
            return redirect( session()->get( 'redirect.url' ) );
       }

        return redirect('home2');
    }
    // Add for login by login_id 20210909 END


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Add for login by login_id 20210909 START
        if ( \request()->get( 'redirect_to' ) ) {
            session()->put( 'redirect.url', \request()->get( 'redirect_to' ) );
        }
        // Add for login by login_id 20210909 END

        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'login_id';
    }
}
