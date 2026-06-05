<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{

    public function index()
    {
        $animals = Animal::with('organization')
            ->where('adoption_status', '募集中')
            ->paginate(6);

        $favoriteIds = [];

        if(Auth::guard('web')->check()) {

            /** @var \App\Models\User $user */
            $user = Auth::guard('web')->user();

            $favoriteIds = $user->favorites()
                ->whereIn('status', ['pending', 'matched'])
                ->pluck('animal_id')
                ->toArray();
        }
        foreach($animals as $animal) {
            $animal->isFavorited = in_array($animal->id, $favoriteIds);
        }

        return view('index', compact('animals'));
    }

    // 動物詳細画面
    public function show(int $id)
    {
        $animal = Animal::with('organization')
            ->where('adoption_status', '募集中')
            ->findOrFail($id);
        return view('animals.show', compact('animal'));
    }

    // 動物登録画面
    public function create()
    {
        $animal = new Animal;
        return view('org.animals.create', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        abort_unless($animal->organization_id === Auth::guard('org')->id(), 403);
        return view('org.animals.edit', compact('animal'));
    }

    // 動物登録保存処理
    public function store(StoreAnimalRequest $request)
    {
        Animal::create([
            'animal_name' => $request->animal_name,
            'species' => $request->species,
            'age' => $request->age,
            'sex' => $request->sex,
            'personality' => $request->personality,
            'health_status' => $request->health_status,
            'comment' => $request->comment,
            'adoption_status' => '募集中',

            'organization_id' => Auth::guard('org')->id(),
        ]);

        return redirect()->route('org.mypage');
    }

    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        $animal->update([
            'animal_name' => $request->animal_name,
            'species' => $request->species,
            'age' => $request->age,
            'sex' => $request->sex,
            'personality' => $request->personality,
            'health_status' => $request->health_status,
            'comment' => $request->comment,
        ]);

        return redirect()->route('org.mypage')->with('success', '動物プロフィールを更新しました');
    }

    public function destroy(Animal $animal)
    {

        if($animal->organization_id !== Auth::guard('org')->id()){
            abort(403);
        }

        if($animal->matche()->exists()) {
            return back()->with(
                'error',
                "{$animal->adoption_status}の動物は削除できません"
            );
        }

        $animal->delete();

        return redirect()->route('org.mypage')->with('success', '削除しました');
    }
}
