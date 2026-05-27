<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::guard('web')->user();
        $favorites = Favorite::with('animal')->where('user_id', Auth::id())->latest()->paginate(3);
        return view('user.mypage', compact('user', 'favorites'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'nickname' => 'required|string|max:255',
            'residence_area' => 'nullable|string|max:255',
            'user_age' => 'nullable|string|max:50',
            'animal_care_experience' => 'nullable|string',
            'animal_care_details' => 'nullable|string',
            'self_introduction' => 'nullable|string',
        ]);

        $user->update($request->only([
            'nickname',
            'residence_area',
            'user_age',
            'animal_care_experience',
            'animal_care_details',
            'self_introduction',
        ]));

        return redirect()->route('user.mypage')->with('success', '更新しました');
    }
}
