<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Notifications\TwoFactorCode;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Sobrescribir la validación del login para agregar captcha
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|email',  // o solo 'required|string' si no usas email como usuario
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha', // validación del captcha
        ]);
    }
    //aqui se esta agregadando para email 
  protected function authenticated(Request $request, $user)
{
    $user->regenerateTwoFactorCode();  // método en el modelo User
    $user->notify(new TwoFactorCode()); // clase notificación que acabas de crear
    return redirect()->route('verify.index');
}
}
