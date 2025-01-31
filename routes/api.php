<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/income-chart', [IncomeController::class, 'incomeChart']);
Route::get('/expense-chart', [ExpenseController::class, 'expenseChart']);
