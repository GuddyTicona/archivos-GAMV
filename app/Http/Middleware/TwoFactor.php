<?php

namespace App\Http\Middleware;

use Closure;

class TwoFactor
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if(auth()->check() && $user->two_factor_code)
        {
            if($user->two_factor_expires_at < now()) // código expirado
            {
                $user->resetTwoFactorCode();
                auth()->logout();

                return redirect()->route('login')
                    ->withMessage('The two factor code has expired. Please login again.');
            }

            // Permitir acceso a cualquier ruta que empiece con 'verify' para evitar loop
            if(!$request->is('verify*'))
            {
                return redirect()->route('verify.index');
            }
        }

        return $next($request);
    }
}
