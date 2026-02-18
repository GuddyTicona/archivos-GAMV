<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorIsEnabled
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Si no hay usuario autenticado, continuar
        if (!$user) {
            return $next($request);
        }

        // Verificar si el usuario NO tiene 2FA confirmado
        if (is_null($user->two_factor_confirmed_at)) {

            // Rutas permitidas mientras configura 2FA
            $allowedRoutes = [
                'profile.security',
                'logout',
            ];

            // Permitir rutas específicas de configuración 2FA (Fortify)
            if (
                !$request->routeIs($allowedRoutes) &&
                !$request->is('user/two-factor*')
            ) {
                return redirect()
                    ->route('profile.security')
                    ->with('warning',
                        'Por razones de seguridad institucional, debe activar y confirmar la autenticación de dos factores para continuar.'
                    );
            }
        }

        return $next($request);
    }
}
