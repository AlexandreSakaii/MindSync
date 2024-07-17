<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = '/MenagerAuth'; // Declarando o tipo da propriedade

    protected function authenticated(Request $request, $user): RedirectResponse // Declarando o tipo de retorno
    {
        // Verifique se o usuário é uma instância de SuperAdmin
        if ($user instanceof \App\Models\SuperAdmin) {
            return redirect()->intended('/SuperAdmMindSync');
        }

        return redirect()->intended($this->redirectTo);
    }

    public function logout(Request $request): RedirectResponse // Declarando o tipo de retorno
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function redirectPath(): string // Declarando o tipo de retorno
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
}
