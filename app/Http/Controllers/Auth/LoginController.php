<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        // Obtén el usuario actualmente autenticado
        $user = Auth::user();
        // Verificar si el usuario está activo
        if ($user->estado == 1) {
            // Verifica el rol del usuario y devuelve la ruta apropiada
            if ($user->rol === 'cliente') {
                return '/pacientes';
            } else {
                return '/home';
            }

        }else{
            Auth::logout();
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public $maxAttempts = 3;
    public $decayMinutes = 1;
    

}
