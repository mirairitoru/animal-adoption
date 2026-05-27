<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
    if (Auth::guard('web')->attempt([
        'email' => $request->email,
        'password' => $request->password,
    ])) {
        return back()->withErrors([
            'email' => 'ログイン失敗しました'
            ])->withInput();
        }
    }
}
