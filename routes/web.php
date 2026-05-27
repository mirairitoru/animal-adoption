<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MatcheController;
use App\Http\Controllers\Org\OrganizationController;
use App\Http\Controllers\Org\OrgAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserMatchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::guard('web')->check() || Auth::guard('org')->check()) {
        return redirect('/animals');
    }
    return view('home');
})->name('home');

Route::get('/animals', [AnimalController::class, 'index'])
    ->middleware(['auth:web,org'])
    ->name('animals');
Route::get('/animals/{id}', [AnimalController::class, 'show'])->name('animals.show');

Route::middleware('auth:org')->group(function () {
    Route::post('/org/logout', function() {
        Auth::guard('org')->logout();
        return redirect('/');
    })->name('org.logout');
    Route::get('/org/mypage', [OrganizationController::class, 'mypage'])->name('org.mypage');
    Route::get('/org/mypage/edit', [OrganizationController::class, 'edit'])->name('org.mypage.edit');
    Route::post('/org/mypage/update', [OrganizationController::class, 'update'])->name('org.mypage.update');

    Route::get('/org/animals/create', [AnimalController::class, 'create'])->name('org.animals.create');
    Route::post('/org/animals', [AnimalController::class, 'store'])->name('org.animals.store');

    Route::get('/org/animals/{id}/edit', [AnimalController::class, 'edit'])->name('org.animals.edit');
    Route::put('/org/animals/{animal}', [AnimalController::class, 'update'])->name('org.animals.update');
    Route::delete('/org/animals/{animal}', [AnimalController::class, 'destroy'])->name('org.animals.destroy');

    Route::get('/org/match', [MatcheController::class, 'index'])->name('org.match.index');
    Route::post('/org/match/{favorite}', [MatcheController::class, 'approve'])->name('org.match.approve');
    Route::patch('/match/{match}/status', [MatcheController::class, 'updateStatus'])->name('org.match.status.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:web')->group(function () {
    Route::post('/logout', function() {
        Auth::guard('web')->logout();
        return redirect('/');
    })->name('logout');
    Route::get('/mypage', [UserController::class, 'mypage'])->name('user.mypage');
    Route::get('/mypage/edit', [UserController::class, 'edit'])->name('mypage.edit');
    Route::post('/mypage/update', [UserController::class, 'update'])->name('mypage.update');

    Route::post('/favorites/{animal}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::delete('/matches/{match}', [MatcheController::class, 'destroy'])->name('matches.destroy');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); 
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/org/register', function() {
    return redirect('/register?role=organization');
});

Route::post('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/org/login', [OrgAuthController::class, 'login'])->name('org.login');

require __DIR__.'/auth.php';