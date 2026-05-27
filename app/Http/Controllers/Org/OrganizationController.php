<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrganizationProfileRequest;
use App\Models\Animal;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{

    public function requests()
    {
        $org = Auth::guard('org')->user();

        $favorites = Favorite::whereHas('animal', function ($query) use($org){
            $query->where('organization_id', $org->id);
        })
        ->with(['user', 'animal'])
        ->latest()
        ->get();

        return view('org.requests', compact('favorites'));
    }
    
    public function mypage()
    {
        $org = Auth::guard('org')->user();
        $animals = Animal::where('organization_id', $org->id)->paginate(6);
        return view('org.mypage', compact('org', 'animals'));
    }

    public function edit()
    {
        $org = Auth::guard('org')->user();
        return view('org.edit', compact('org'));
    }

    public function update(UpdateOrganizationProfileRequest $request)
    {
        /** @var \App\Models\Organization $org */
        $org = Auth::guard('org')->user();

        if(!$org) {
            return redirect()->route('/');
        }

        // バリデーション
        $org->update($request->validated());

        // 更新
        return redirect()->route('org.mypage')->with('success', 'プロフィール更新しました');
    }
}
