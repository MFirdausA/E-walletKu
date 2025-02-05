<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\tag;
use App\Models\wallet;
use App\Models\category;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user()->id;
        $wallets = wallet::all();
        $categories = category::all();
        $tags = tag::all();
        $transactionType = TransactionType::all();
        $transactionName = $transactionType->firstWhere('id', 4)->name;
        $transactionid = $transactionType->firstWhere('id', 4)->id;
        return view('pages.expense.create', compact('wallets', 'categories', 'tags', 'transactionType', 'transactionName', 'transactionid', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|date',
            'wallet_id' => 'required',
            'user_id'=>'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        transaction::create([
            'title' => $request->title,
            'transaction_type_id' => $request->transaction_type_id,
            'description' => $request->description,
            'date' => $request->date,
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'tag_id' => $request->tag_id,
            'user_id' => $request->user_id,
        ]);
        return redirect()->route('home.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $filterType = $request->input('filterType');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $query = Transaction::where('transaction_type_id', 4);
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
                } elseif ($startDate ) {
                    // Jika hanya startDate diisi, cari transaksi setelah atau pada startDate
                    $query->where('date', '>=', $startDate);
                } elseif ($endDate) {
                    // Jika hanya endDate diisi, cari transaksi sebelum atau pada endDate
                    $query->where('date', '<=', $endDate);
                }
                break;
        }

        $transactions = $query->get();
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = $query->sum('amount');
        return view('pages.expense.detail', compact('transactions', 'expenseAmount', 'filterType'));
    }

    public function expenseChart()
    {
    $expenseTransactions = Transaction::where('transaction_type_id', 4)
        // ->whereMonth('date', Carbon::now()->month)
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
