<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::guard('web')->check() || Auth::guard('org')->check()) {
            return redirect('/animals');
        }
        return view('home');
    }

    public function orgRegister()
    {
        return redirect('/register?role=organization');
    }
}
