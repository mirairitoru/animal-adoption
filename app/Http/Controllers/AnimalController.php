<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{

    public function index()
    {
        $animals = Animal::with('organization')->paginate(6);

        if(Auth::guard('web')->check()) {

            /** @var \App\Models\User $user */
            $user = Auth::guard('web')->user();

            $favoriteIds = $user->favorites()->pluck('animal_id')->toArray();

            foreach($animals as $animal) {
                $animal->isFavorited = in_array($animal->id, $favoriteIds);
            }
        } else {
            foreach($animals as $animal) {
                $animal->isFavorited = false;
            }
        }

        return view('index', compact('animals'));
    }

    // 動物詳細画面
    public function show(int $id)
    {
        $animal = Animal::with('organization')->findOrFail($id);
        return view('animals.show', compact('animal'));
    }

    // 動物登録画面
    public function create()
    {
        $animal = new Animal;
        return view('org.animals.create', compact('animal'));
    }

    public function edit(int $id)
    {
        $animal = Animal::findOrFail($id);
        return view('org.animals.edit', compact('animal'));
    }

    // 動物登録保存処理
    public function store(Request $request)
    {
        Animal::create([
            'animal_name' => $request->animal_name,
            'species' => $request->species,
            'age' => $request->age,
            'sex' => $request->sex,
            'personality' => implode(',', $request->personality ?? []),
            'health_status' => $request->health_status,
            'comment' => $request->comment,
            'adoption_status' => '募集中',

            'organization_id' => Auth::guard('org')->id(),
        ]);

        return redirect()->route('org.mypage');
    }

    public function update(Request $request, Animal $animal)
    {
        $animal->update([
            'animal_name' => $request->animal_name,
            'species' => $request->species,
            'age' => $request->age,
            'sex' => $request->sex,
            'personality' => implode(',', $request->personality ?? []),
            'health_status' => $request->health_status,
            'comment' => $request->comment,
        ]);

        return redirect()->route('org.mypage');
    }

    public function destroy(Animal $animal)
    {
        if($animal->organization_id !== Auth::guard('org')->id()){
            abort(403);
        }

        $animal->delete();

        return redirect()->route('org.mypage')->with('success', '削除しました');
    }
}
