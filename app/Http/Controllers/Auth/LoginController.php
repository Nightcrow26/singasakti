<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function username()
    {
        return 'username';
    }

    public function authenticated(Request $request, $user)
    {
        // if ($user->hasRole('admin')) {
        //     return redirect()->route('home.admin');
        // }
        // elseif ($user->hasRole('user')) {
        //     return redirect()->route('home');
        // }
        // elseif ($user->hasRole('skpd')) {
        //     return redirect()->route('home.skpd');
        // }

        return redirect()->route('home.admin');
    }

    public function logout(Request $request)
    {
        // $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
