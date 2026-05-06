<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatcheController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $orgUser = Auth::guard('org')->user();

        if(!$orgUser) {
            abort(403);
        }

        // 自分の投稿した動物のみ
        $animals = Animal::where('organization_id', $orgUser->id)
            ->withCount('favorites')
            ->get();
        
        // 選択された動物(なければ最初)
        $selectedAnimalId = $request->animal_id ?? $animals->first()?->id;

        $selectedAnimal = Animal::where('organization_id', $orgUser->id)
            ->with(['matches'])
            ->find($selectedAnimalId);

        // マッチ済みユーザーID
        $matchedUserIds = $selectedAnimal
            ? $selectedAnimal->matches->pluck('user_id')
            : collect();

        // 興味ありユーザー(マッチ未承認のみ)
        $favoritedUsers = $selectedAnimal
            ? $selectedAnimal->favorites()
                ->whereNotIn('user_id', $matchedUserIds)
                ->with('user')
                ->get()
            : collect();

        return view('org.match.index', compact(
            'animals',
            'selectedAnimal',
            'favoritedUsers'
        ));
    }
}
