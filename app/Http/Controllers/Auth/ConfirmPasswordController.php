<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
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
        $this->middleware('auth');
    }

    public function confirmarPassword(Request $request)
    {
         // Obtenemos el número actual de intentos del usuario.
        $attempts = session('confirmation-attempt', 0);

        // Verificamos si el usuario ha alcanzado el límite máximo de intentos.
        if ($attempts >= 3) {
            return response()->json(['success' => false, 'message' => 'Has alcanzado el límite máximo de intentos. Por favor, inténtalo de nuevo más tarde.', 'maxIntentos' => $attempts]);
        }
        $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:8'],
        ]);
    
        $isMatch = Hash::check($request->input('password'), auth()->user()->password);
    
        if ($isMatch) {
            // Si la contraseña es correcta, reiniciamos el número de intentos y regresamos una respuesta exitosa.
            session()->forget('confirmation-attempt');
            return response()->json(['success' => true]);
        } else {
            // Si la contraseña es incorrecta, incrementamos el número de intentos y regresamos una respuesta con un mensaje de error.
            $attempts++;
            session()->put('confirmation-attempt', $attempts);
            if ($attempts >= 3) {
                session()->put('confirmation-blocked', true);
            }
            if ($attempts == 3) {
                session()->forget('confirmation-attempt');
             }
            return response()->json(['success' => false, 'message' => 'La contraseña no coincide con la registrada.', 'maxIntentos' => $attempts]);
        }
    }
}
