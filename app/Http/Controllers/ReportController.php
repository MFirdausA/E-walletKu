<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = transaction::where('transaction_type_id', $income->id)->sum('amount');
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = transaction::where('transaction_type_id', $expense->id)->sum('amount');
        $totalAmount = $incomeAmount + $expenseAmount;
        return view('pages.report.index', compact('incomeAmount', 'expenseAmount', 'totalAmount'));
    }

    public function incomeChart()
    {
    $incomeTransactions = Transaction::where('transaction_type_id', 1)
        ->with('category')
        ->get();

    $data = $incomeTransactions->groupBy('category.name')->map(function ($transactions, $category) {
        return [
            'category' => $category,
            // date
            'amount' => $transactions->sum('amount')
        ];
    })->values();

    return response()->json($data);
    }

    public function expenseChart()
    {
    $expenseTransactions = Transaction::where('transaction_type_id', 4)
        ->with('category')
        ->get();

    $data = $expenseTransactions->groupBy('category.name')->map(function ($transactions, $category) {
        return [
            'category' => $category,
            'amount' => $transactions->sum('amount')
        ];
    })->values();

    return response()->json($data);
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
