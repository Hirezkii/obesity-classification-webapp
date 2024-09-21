<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserInputController;
use App\Http\Controllers\PersonAttributeController;


Route::get('/', function () {
    return view('user.home');
});

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/timer', function () {
    return view('timer');
});
Route::get('/accuracies', function () {
    return view('admin.accuracies');
});

Route::get('/user', function () {
    return view('admin.user');
});
Route::resource('user-input', UserInputController::class);
Route::post('/user-input/move-all', [UserInputController::class, 'moveToPersonAttributeAll'])->name('moveToPersonAttributeAll');
Route::delete('/user-input/delete-all', [UserInputController::class, 'deleteAll'])->name('user-input.deleteAll');
Route::resource('dataset', PersonAttributeController::class);

require __DIR__ . '/auth.php';
