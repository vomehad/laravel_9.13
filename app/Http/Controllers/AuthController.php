<?php

namespace App\Http\Controllers;

use App\Helpers\NameHelper;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    public function login(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return redirect(route('Account'));
        }

        return view('auth.login', [
            'title' => Lang::get('Auth.' . NameHelper::getActionName()),
//            'nav' => $this->nav,
        ]);
    }

    public function store(LoginRequest $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            return redirect(route('Account'));
        }

        $formFields = $request->only(['email', 'password']);

        if (Auth::attempt($formFields)) {
            return redirect()->intended(route('Account'));
        }

        return redirect(route('Login'))->withErrors([
            'email' => 'Login Fault',
        ]);
    }

    public function signUp(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return redirect(route('Account'));
        }

        return view('auth.sign-up', [
            'title' => Lang::get('Auth.' . NameHelper::getActionName()),
        ]);
    }

    public function create(LoginRequest $request)
    {
        if (Auth::check()) {
            return redirect(route('Account'));
        }

        if (User::where('email', $request->input('email'))->exists()) {
            return redirect(route('SignUp'))->withErrors([
                'email' => 'Already exist'
            ]);
        }

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        if ($user->save()) {
            Auth::login($user);

            return redirect(route('Account'))->with('success', 'Login!1');
        }

        return redirect(route('Login'))->withErrors([
            'sign' => 'Аунтификация не удалась',
        ]);
    }

    public function logout(): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        return redirect(route('Home'));
    }
}
