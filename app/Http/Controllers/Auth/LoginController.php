<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/');
        }

        return redirect()
            ->back()
            ->withErrors(['invalidCredentials' => 'Invalid email and/or password. Please try again'])
            ->withInput($request->only('email'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('/login');
    }
}
