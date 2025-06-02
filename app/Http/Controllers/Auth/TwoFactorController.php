<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCode;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        // Middleware que asegura que el usuario esté autenticado y tenga la verificación 2FA pendiente
        $this->middleware(['auth', 'twofactor']);
    }

    /**
     * Mostrar el formulario para ingresar el código 2FA
     */
    public function index() 
    {
        return view('auth.twoFactor');
    }

    /**
     * Verificar el código 2FA enviado por el usuario
     */
    public function store(Request $request)
    {
        // Validar que el código sea requerido y numérico
        $request->validate([
            'two_factor_code' => 'required|integer',
        ]);

        $user = auth()->user();

        // Verificar que el código ingresado coincida y no haya expirado (si manejas expiración)
        if ($request->input('two_factor_code') == $user->two_factor_code 
            && (is_null($user->two_factor_expires_at) || now()->lessThan($user->two_factor_expires_at))
        ) {
            // Resetear el código para no poder usarlo otra vez
            $user->resetTwoFactorCode();

            // Redirigir al home o dashboard luego de la verificación exitosa
            return redirect()->route('admin.home');
        }

        // En caso de error, regresar con mensaje
        return redirect()->back()->withErrors(['two_factor_code' => 'The two factor code you have entered is invalid or expired']);
    }

    /**
     * Reenviar el código 2FA al usuario vía email
     */
    public function resend()
    {
        $user = auth()->user();

        // Regenerar el código y notificar al usuario
        $user->regenerateTwoFactorCode();
        $user->notify(new TwoFactorCode());

        // Volver a la vista con un mensaje informativo
        return redirect()->back()->with('message', 'The two factor code has been sent again');
    }
}
