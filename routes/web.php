<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(["prefix" => "home", "as" => "home."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\HomeController@index', 'as' => 'index']);
    });
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
});

require __DIR__.'/auth.php';
