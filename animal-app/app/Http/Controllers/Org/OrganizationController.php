<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
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

    public function update(Request $request)
    {
        /** @var \App\Models\Org $org */
        $org = Auth::guard('org')->user();

        if(!$org) {
            return redirect()->route('/');
        }

        // バリデーション
        $request->validate([
            'org_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'activity_description' => 'nullable|string',
            'adoption_summary' => 'nullable|string',
        ]);

        // 更新
        $org->update([
            'org_name' => $request->org_name,
            'contact_name' => $request->contact_name,
            'location' => $request->location,
            'activity_description' => $request->activity_description,
            'adoption_summary' => $request->adoption_summary,
        ]);

    // リダイレクト
        return redirect()->route('org.mypage')->with('success', '更新しました');
    }
}
