<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return Socialite::driver('b2systems')
                        ->redirect();
    }

    public function callback()
    {
        /** @var \App\User $user */
        $user = Socialite::driver('b2systems')->user();

        User::firstOrCreate(
            ['id' => $user->id],
            ['token' => $user->token, 'name' => $user->name, 'refresh_token' => $user->refreshToken]
        );

        Auth::login($user, true);

        return redirect('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect(config('services.b2systems.instance_uri') . '/logout');
    }
}
