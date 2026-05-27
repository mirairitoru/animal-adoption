<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrgAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'org_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:organizations,email'],
            'password' => ['required', 'confirmed'],
        ],[
            'org_name.required' => '団体名は必須です',
            'contact_name.required' => '担当者名は必須です',
            'email.required' => 'メールは必須です',
            'password.required' => 'パスワードは必須です', 
        ]);

        $org = Organization::create([
            'org_name' => $request->org_name,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::guard('org')->login($org);

        return redirect('/animals');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

    if (Auth::guard('org')->attempt([
        'email' => $request->email,
        'password' => $request->password,
    ])) {
        return redirect()->route('animals');
    }

    return back()->withErrors([
        'email' => 'ログインに失敗しました'
        ])->withInput()->with('login_type', 'org');
    }
}
