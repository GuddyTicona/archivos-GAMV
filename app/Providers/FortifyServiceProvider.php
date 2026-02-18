<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//definicion de vistas
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });

        Fortify::confirmPasswordView(function () {
        return view('auth.passwords.confirm');
        });

        // Lógica de autenticación personalizada con reCAPTCHA
        Fortify::authenticateUsing(function (Request $request) {
            // Validar reCAPTCHA
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
                'g-recaptcha-response' => 'required|captcha',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                
             
                if ($user->two_factor_secret && !$user->two_factor_confirmed_at) {
                    $user->two_factor_secret = null;
                    $user->two_factor_recovery_codes = null;
                    $user->save();
                }
                
                return $user;
            }

            return null;
        });


        RateLimiter::for('login', function (Request $request) {
            $throttleKey = $request->input('email').'|'.$request->ip();
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}