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
        $transactions = transaction::whereMonth('date', Carbon::now()->month)->get();
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = transaction::where('transaction_type_id', $income->id)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('amount');
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = transaction::where('transaction_type_id', $expense->id)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('amount');
        $amount = $incomeAmount - $expenseAmount;
        $categoryTransaction =  Category::pluck('name');
        $dateFormat =  carbon::now()->format('F d');
        $dateOfDay =  carbon::now()->format('l');
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

    public function filter(Request $request)
    {
    $filterType = $request->input('filterType');
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');

    $query = Transaction::query();

    switch ($filterType) {
        case 'daily':
            $query->whereDate('date', Carbon::today('Asia/Jakarta'));
            break;
        case 'monthly':
            $query->whereMonth('date', Carbon::now('Asia/Jakarta')->month);
            break;
        case 'yearly':
            $query->whereYear('date', Carbon::now('Asia/Jakarta')->year);
            break;
        case 'custom':
            if ($startDate && $endDate) {
                // Jika kedua tanggal diisi, gunakan whereBetween
                $query->whereBetween('date', [$startDate, $endDate]);
            } elseif ($startDate) {
                // Jika hanya startDate diisi, cari transaksi setelah atau pada startDate
                $query->where('date', '>=', $startDate);
            } elseif ($endDate) {
                // Jika hanya endDate diisi, cari transaksi sebelum atau pada endDate
                $query->where('date', '<=', $endDate);
            }
            break;
    }

    $transactions = $query->get();
    $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = transaction::where('transaction_type_id', $income->id)->sum('amount');
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = transaction::where('transaction_type_id', $expense->id)->sum('amount');
        $amount = $incomeAmount - $expenseAmount;
        $categoryTransaction =  Category::pluck('name');
        $dateFormat =  Carbon::now('Asia/Jakarta')->format('F d');
        $dateOfDay =  Carbon::now('Asia/Jakarta')->format('l');
    // Return the filtered transactions to the view
    return view('pages.home', [
        'transactions' => $transactions,
        'amount' => $amount,
        'incomeAmount' => $incomeAmount,
        'expenseAmount' => $expenseAmount,
        'categoryTransaction' => $categoryTransaction,
        'dateFormat' => $dateFormat,
        'dateOfDay' => $dateOfDay,
        // Other data you want to pass to the view
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