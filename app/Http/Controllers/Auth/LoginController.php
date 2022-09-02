<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            echo "valido";
            return redirect()->intended('dashboard');
        }
    }*/

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

       // $credentials['email'] = $request->username;
       // $credentials['password'] = $request->password;

        //dd($credentials);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            echo "Valido";
            //return redirect()->intended('dashboard');
        } else{
            echo "inválido";
        }
    }

    public function redirectTo()
    {

        $role = Auth::user()->rol->key;

        switch ($role) {
            case 'admin':
                return '/dashboard/post';
                break;

            default:
                return "/";
                break;
        }
    }
}
