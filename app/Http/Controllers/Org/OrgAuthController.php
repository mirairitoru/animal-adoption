<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrgAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
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
