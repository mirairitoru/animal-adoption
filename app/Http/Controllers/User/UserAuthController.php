<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\directoryExists;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();
            return redirect()->intended(route('animals'));
        }
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
            ])->withInput()->with('login_type', 'user');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }
}

