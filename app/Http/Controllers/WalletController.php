<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transfer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $transaction = Transaction::where('user_id', $user)->get();
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
        $incomeAmount = Transaction::where('transaction_type_id', $income->id)->sum('amount');
        // dd($income);
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = Transaction::where('transaction_type_id', $expense->id)->sum('amount');
        session(['user_id' => $user]);
        return view('pages.wallet.detail', compact('incomeAmount', 'expenseAmount', 'wallets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => session('user_id'),
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $path = $file->storeAs('covers', "Icon-{$request->name}.{$file->extension()}", 'public');
        }

        Wallet::create([
            'name' => $request->name,
            'cover' => $path,
            'user_id' => $request->user_id
        ]);
        return redirect()->route('wallet.create')->with('success', 'Wallet created successfully');
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
        $wallet = Wallet::findOrFail($id);
        $filePath = $wallet->cover;

        $request->merge([
            'user_id' => session('user_id'),
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            // Hapus file lama jika ada
            if ($wallet->cover) {
                Storage::delete('public/' . $wallet->cover);
            }
            // Simpan file baru
            $file = $request->file('cover');
            $path = $file->storeAs('covers', "Icon-{$request->name}.{$file->extension()}", 'public');
            
            $filePath = $path;
        }

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $wallet->update([
            'name' => $request->name,
            'cover' => $filePath,
            'user_id' => $request->user_id
        ]);
        return redirect()->route('wallet.create')->with('success', 'Wallet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wallet = Wallet::findOrFail($id);
        $wallet->delete();
        return redirect()->route('wallet.create')->with('success', 'Wallet deleted successfully');
    }
}
