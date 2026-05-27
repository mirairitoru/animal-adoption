<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Favorite;
use App\Models\Matche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatcheController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $orgUser = Auth::guard('org')->user();

        if(!$orgUser) {
            abort(403);
        }

        $type = $request->type ?? 'favorite';

        if($type === 'matched') {
            // 自分の投稿した動物のみ
            $animals = Animal::where('organization_id', $orgUser->id)
                ->where('adoption_status', 'マッチ中')
                ->with('matches')
                ->withCount('matches')
                ->get();
        } else {
            $animals = Animal::where('organization_id', $orgUser->id)
                ->where('adoption_status', '募集中')
                ->withCount([
                    'favorites as favorites_count' => function($query) {
                        $query->where('status', 'pending');
                    }
                ])
                ->whereHas('favorites', function($query) {
                    $query->where('status', 'pending');
                })
                ->get();
        }

        // 選択された動物(なければ最初)
        $selectedAnimalId = $request->animal_id ?? $animals->first()?->id;

        $selectedAnimal = Animal::where('organization_id', $orgUser->id)
            ->with(['matches'])
            ->find($selectedAnimalId);

        // 興味ありユーザー(マッチ未承認のみ)
        $favoritedUsers = $selectedAnimal
            ? $selectedAnimal->favorites()
                ->where('status', 'pending')
                ->with('user')
                ->paginate(3)
            : collect();

        $matchedUsers = $selectedAnimal
            ? $selectedAnimal->matches()
                ->with('user')
                ->get()
            : collect();

        return view('org.match.index', compact(
            'animals',
            'selectedAnimal',
            'favoritedUsers',
            'matchedUsers',
            'type'
        ));
    }

    public function approve(Favorite $favorite)
    {
        DB::transaction(function () use($favorite) {

            $animal = $favorite->animal;

            $favorite->update([
                'status' => 'matched',
            ]);

            Matche::create([
                'user_id' => $favorite->user_id,
                'animal_id' => $favorite->animal_id,
                'status' => '譲渡準備中',
            ]);

            $animal->update([
                'adoption_status' => 'マッチ中',
            ]);

            Favorite::where('animal_id', $animal->id)
                ->where('id', '!=', $favorite->id)
                ->update([
                    'status' => 'cancelled',
                ]);
        });

        return back()->with('match_success', 'マッチ承認しました。');
    }

    public function updateStatus(Request $request, Matche $match)
    {
        $match->update([
            'status' => $request->status,
        ]);

        if($request->status === '譲渡完了') {

            $animal = $match->animal;

            if($animal) {
                $animal->update([
                    'adoption_status' => '譲渡完了'
                ]);
            }
        }

        return back()->with('success', '進行管理ステータスを更新しました。');
    }

    public function destroy(Matche $match)
    {
        $animal = $match->animal;

        $favorite = Favorite::where('user_id', $match->user_id)
            ->where('animal_id', $match->animal_id)
            ->latest()
            ->first();

        if($favorite) {
            $favorite->delete();
        }

        $match->delete();

        if($animal && $animal->matches()->count() === 0) {
            $animal->update([
                'adoption_status' => '募集中',
            ]);
        }

        return back()->with('success', 'マッチをキャンセルしました。');
    }
}
