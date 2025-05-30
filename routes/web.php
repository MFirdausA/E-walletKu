<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/', ['uses' => 'App\Http\Controllers\HomeController@index', 'as' => 'home.index']);
    Route::get('/settings', ['uses' => 'App\Http\Controllers\SettingController@index', 'as' => 'settings']);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::group(["prefix" => "category", "as" => "category."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\CategoryController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'App\Http\Controllers\CategoryController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\CategoryController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'App\Http\Controllers\CategoryController@edit', 'as' => 'edit']);
        Route::put('/update/{id}', ['uses' => 'App\Http\Controllers\CategoryController@update', 'as' => 'update']);
        Route::get('/detail', ['uses' => 'App\Http\Controllers\CategoryController@show', 'as' => 'show']);
        Route::delete('/destroy/{id}', ['uses' => 'App\Http\Controllers\CategoryController@destroy', 'as' => 'destroy']);
    });

    Route::group(["prefix" => "wallet", "as" => "wallet."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\WalletController@index', 'as' => 'index']);
        Route::get('/detail', ['uses' => 'App\Http\Controllers\WalletController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\WalletController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'App\Http\Controllers\WalletController@edit', 'as' => 'edit']);
        Route::put('/update/{id}', ['uses' => 'App\Http\Controllers\WalletController@update', 'as' => 'update']);
        Route::delete('/destroy/{id}', ['uses' => 'App\Http\Controllers\WalletController@destroy', 'as' => 'destroy']);
    });

    Route::group(["prefix" => "income", "as" => "income."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\IncomeController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'App\Http\Controllers\IncomeController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\IncomeController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'App\Http\Controllers\IncomeController@edit', 'as' => 'edit']);
        Route::put('/update/{id}', ['uses' => 'App\Http\Controllers\IncomeController@update', 'as' => 'update']);
        Route::get('/detail', ['uses' => 'App\Http\Controllers\IncomeController@show', 'as' => 'show']);
        Route::delete('/destroy/{id}', ['uses' => 'App\Http\Controllers\IncomeController@destroy', 'as' => 'destroy']);
    });

    Route::group(["prefix" => "expense", "as" => "expense."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\ExpenseController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'App\Http\Controllers\ExpenseController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\ExpenseController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'App\Http\Controllers\ExpenseController@edit', 'as' => 'edit']);
        Route::put('/update/{id}', ['uses' => 'App\Http\Controllers\ExpenseController@update', 'as' => 'update']);
        Route::get('/detail', ['uses' => 'App\Http\Controllers\ExpenseController@show', 'as' => 'show']);
        Route::delete('/destroy/{id}', ['uses' => 'App\Http\Controllers\ExpenseController@destroy', 'as' => 'destroy']);
    });

    Route::group(["prefix" => "transfer", "as" => "transfer."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\TransferController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'App\Http\Controllers\TransferController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\TransferController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'App\Http\Controllers\TransferController@edit', 'as' => 'edit']);
        Route::put('/update/{id}', ['uses' => 'App\Http\Controllers\TransferController@update', 'as' => 'update']);
        Route::get('/detail', ['uses' => 'App\Http\Controllers\TransferController@show', 'as' => 'show']);
        Route::delete('/destroy/{id}', ['uses' => 'App\Http\Controllers\TransferController@destroy', 'as' => 'destroy']);
    });

    Route::group(["prefix" => "planned", "as" => "planned."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\PlannedController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'App\Http\Controllers\PlannedController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\PlannedController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'App\Http\Controllers\PlannedController@edit', 'as' => 'edit']);
        Route::put('/update/{id}', ['uses' => 'App\Http\Controllers\PlannedController@update', 'as' => 'update']);
        Route::get('/detail', ['uses' => 'App\Http\Controllers\PlannedController@show', 'as' => 'show']);
        Route::delete('/destroy/{id}', ['uses' => 'App\Http\Controllers\PlannedController@destroy', 'as' => 'destroy']);
    });

    Route::group(["prefix" => "report", "as" => "report."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\ReportController@index', 'as' => 'index']);
    });
    // web.php
    Route::get('/transaction-detail', ['uses' => 'App\Http\Controllers\TransactionDetailController@TransactionDetail', 'as' => 'pages.transaction-detail']);
    Route::get('/transaction-save/{id}', ['uses' => 'App\Http\Controllers\TransactionDetailController@TransactionSave', 'as' => 'pages.transaction-save']);
    Route::get('/home/filter', [HomeController::class, 'filter'])->name('home.filter');
    Route::get('/report/filter', [ExpenseController::class, 'show'])->name('report.filter');
    Route::put('planned-payment/pay/{id}', ['uses' => 'App\Http\Controllers\HomeController@payPlanned', 'as' => 'planned.pay']);
    Route::delete('planned-payment/skip/{id}', ['uses' => 'App\Http\Controllers\HomeController@skipPlanned', 'as' => 'planned.skip']);
});

require __DIR__.'/auth.php';
