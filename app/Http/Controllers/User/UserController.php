<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\Favorite;
use App\Models\Matche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::guard('web')->user();
        $favorites = Favorite::with('animal')->where('user_id', Auth::id())->where('status', 'pending')->latest()->paginate(3);
        $matches = Matche::where('user_id', $user->id)->with('animal')->paginate(3);
        return view('user.mypage', compact(
            'user',
            'favorites',
            'matches',
        ));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(UpdateUserProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update($request->validated());

        return redirect()->route('user.mypage')->with('success', 'プロフィールを更新しました');
    }
}
