<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = transaction::all();
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = transaction::where('transaction_type_id', $income->id)->sum('amount');
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = transaction::where('transaction_type_id', $expense->id)->sum('amount');
        $amount = $income->transactions()->sum('amount') - $expense->transactions()->sum('amount');
        $categoryTransaction =  Category::pluck('name');
        $dateTransaction = Transaction::first()->date;
        $dateFormat =  carbon::parse($dateTransaction)->format('F d');
        $dateOfDay =  carbon::parse($dateTransaction)->format('l');
        return view('pages.home',[
        'transactions' => $transactions,
        'amount' => $amount, 
        'incomeAmount' => $incomeAmount, 
        'expenseAmount' => $expenseAmount,
        'categoryTransaction' => $categoryTransaction,
        'dateFormat' => $dateFormat,
        'dateOfDay' => $dateOfDay
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}