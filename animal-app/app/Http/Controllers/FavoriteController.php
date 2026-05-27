<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function store(int $animalId)
    {

        $userId = Auth::id();

        $exists = Favorite::where('user_id', $userId,)
            ->where('animal_id',$animalId)
            ->exists();

        if($exists) {
            return back()->with('error', 'すでに興味あり登録されています');
        }

        Favorite::create([
            'user_id' => $userId,
            'animal_id' => $animalId,
        ]);

        return back()->with('success', '興味ありに追加しました');
    }

    public function index()
    {
        $favorites = Favorite::with('animal')->where('user_id', Auth::id())->latest()->get();
        return view('favorites.index', compact('favorites'));
    }

    public function destroy(int $id)
    {
        $favorite = Favorite::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $favorite->delete();

        return back();        
    }
}
