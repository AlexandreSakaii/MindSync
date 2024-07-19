<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use App\Models\Plano;
use App\Models\Psychologist;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = '/MenagerAuth';

    protected function guard()
    {
        $userType = session('user_type') ?: request()->input('user_type');
        Log::info('Determining guard for user type:', ['user_type' => $userType]);

        switch ($userType) {
            case 'superadmin':
                Log::info('Using superadmin guard');
                return Auth::guard('superadmin');
            case 'psychologist':
                Log::info('Using psychologist guard');
                return Auth::guard('psychologist');
            default:
                Log::info('Using default web guard');
                return Auth::guard('web');
        }
    }

    protected function authenticated(Request $request, $user): RedirectResponse
    {
        Log::info('User authenticated:', ['user' => $user]);

        if ($user instanceof User && $user->is_superadmin) {
            Log::info('Redirecting to SuperAdmMindSync');
            return redirect()->intended('/SuperAdmMindSync');
        }

        if ($user instanceof Psychologist) {
            Log::info('Redirecting to Deshboard');
            return redirect()->intended('/Deshboard');
        }

        $plano = Plano::where('nome', $user->plan_name)->first();
        if ($plano) {
            $request->session()->put('plano', $plano);
            Log::info('Plano armazenado na sessão', ['plano' => $plano]);
        } else {
            Log::error('Plano não encontrado', ['plan_name' => $user->plan_name]);
        }

        Log::info('Redirecting to ' . $this->redirectTo);
        return redirect()->intended($this->redirectTo);
    }

    public function logout(Request $request): RedirectResponse
    {
        Log::info('User logout:', ['user' => Auth::user()]);

        $guard = $this->guard();
        $guard->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('user_type'); // Ensure user type is cleared

        return redirect('/');
    }

    protected function redirectPath(): string
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    public function login(Request $request)
    {
        Log::info('Login attempt:', ['email' => $request->email, 'user_type' => $request->input('user_type')]);

        // Limpa qualquer sessão anterior antes de iniciar um novo login
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $this->validateLogin($request);

        // Verifica o domínio do email e ajusta o user_type conforme necessário
        $email = $request->input('email');
        if (strpos($email, '@SuperAdmMindSync.com') !== false) {
            session(['user_type' => 'superadmin']);
            Log::info('Email pertence a um superadmin, ajustando user_type para superadmin');
        } else {
            session(['user_type' => $request->input('user_type')]);
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            Log::info('Login successful');
            return $this->sendLoginResponse($request);
        }

        Log::warning('Login failed');
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request): void
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'user_type' => 'required|string',
        ]);
    }

    protected function username(): string
    {
        return 'email';
    }

    protected function credentials(Request $request): array
    {
        return $request->only($this->username(), 'password');
    }

    protected function attemptLogin(Request $request): bool
    {
        $credentials = $this->credentials($request);
        $userType = session('user_type');

        // Check if user_type is superadmin and verify if the email belongs to a superadmin
        if ($userType === 'superadmin') {
            $user = User::where('email', $credentials['email'])->first();
            if ($user && $user->is_superadmin) {
                Log::info('Superadmin credentials verified.');
                return $this->guard()->attempt($credentials, $request->filled('remember'));
            } else {
                Log::warning('Attempt to login as superadmin with non-superadmin account.');
                return false;
            }
        }

        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }

    protected function sendLoginResponse(Request $request): RedirectResponse
    {
        Log::info('Login response sent');
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request): RedirectResponse
    {
        Log::error('Failed login response sent');
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function hasTooManyLoginAttempts(Request $request): bool
    {
        return app(\Illuminate\Cache\RateLimiter::class)->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts()
        );
    }

    protected function incrementLoginAttempts(Request $request): void
    {
        app(\Illuminate\Cache\RateLimiter::class)->hit(
            $this->throttleKey($request), $this->decayMinutes() * 60
        );
    }

    protected function sendLockoutResponse(Request $request): RedirectResponse
    {
        $seconds = app(\Illuminate\Cache\RateLimiter::class)->availableIn(
            $this->throttleKey($request)
        );

        Log::warning('Account locked due to too many login attempts');
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.throttle', ['seconds' => $seconds])],
        ])->status(423);
    }

    protected function fireLockoutEvent(Request $request): void
    {
        event(new \Illuminate\Auth\Events\Lockout($request));
    }

    protected function clearLoginAttempts(Request $request): void
    {
        app(\Illuminate\Cache\RateLimiter::class)->clear($this->throttleKey($request));
    }

    protected function throttleKey(Request $request): string
    {
        return \Illuminate\Support\Str::lower($request->input($this->username())).'|'.$request->ip();
    }

    protected function maxAttempts(): int
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    protected function decayMinutes(): int
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }
}
