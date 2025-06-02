<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

class ProfileController extends Controller
{
    public function twofa()
    {
        $user = auth()->user();
        $google2fa = new Google2FA();

        if (!$user->twofa_secret) {
            $user->twofa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $inlineUrl = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->twofa_secret
        );

        return view('profile.2fa', compact('user', 'inlineUrl'));
    }

    public function twofaEnable(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = auth()->user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($user->twofa_secret, $request->otp);

        if ($valid) {
            $user->twofa_enabled = true;
            $user->save();
            return redirect()->route('home')->with('success', '2FA activado correctamente.');
        }

        return redirect()->back()->withErrors(['otp' => 'Código OTP inválido.']);
    }
}
