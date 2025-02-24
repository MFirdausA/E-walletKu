<?php

namespace App\Http\Controllers;

use App\Models\wallet;
use App\Models\transfer;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.wallet.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user()->id;
        $transaction = transaction::where('user_id', $user)->get();
        $wallets = Wallet::whereNull('user_id')->orWhere('user_id', $user)->get()->map(function ($wallet) use ($user) {
            $incomeAmount = Transaction::where('wallet_id', $wallet->id)
                ->whereHas('transactionType', function ($query) {
                    $query->where('name', 'Income');
                })
                ->where('user_id', $user)
                ->sum('amount');
    
            $expenseAmount = Transaction::where('wallet_id', $wallet->id)
                ->whereHas('transactionType', function ($query) {
                    $query->where('name', 'Expense');
                })
                ->where('user_id', $user)
                ->sum('amount');

            $tranferIn = Transfer::where('to_wallet_id', $wallet->id)
                ->where('user_id', $user)
                ->sum('amount');
            $tranferOut = Transfer::where('wallet_id', $wallet->id)
                ->where('user_id', $user)
                ->sum('amount');
                
            $wallet->incomeAmount = $incomeAmount + $tranferIn;
            $wallet->expenseAmount = $expenseAmount + $tranferOut;
            $wallet->remainingBalance = ($incomeAmount - $expenseAmount) + ($tranferIn - $tranferOut);
    
            return $wallet;
        });
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = transaction::where('transaction_type_id', $income->id)->sum('amount');
        // dd($income);
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = transaction::where('transaction_type_id', $expense->id)->sum('amount');
        return view('pages.wallet.detail', compact('incomeAmount', 'expenseAmount', 'wallets'));
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
