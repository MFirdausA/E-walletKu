<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\tag;
use App\Models\wallet;
use App\Models\category;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use App\Models\transfer;
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
        $wallets = Wallet::whereNull('user_id')->orWhere('user_id', $user)->get()->map(function ($wallet) {
            $incomeAmount = Transaction::where('wallet_id', $wallet->id)
                ->whereHas('transactionType', function ($query) {
                    $query->where('name', 'Income');
                })
                ->sum('amount');
    
            $expenseAmount = Transaction::where('wallet_id', $wallet->id)
                ->whereHas('transactionType', function ($query) {
                    $query->where('name', 'Expense');
                })
                ->sum('amount');

            $user = Auth::user()->id;
            $transferIn = Transfer::where('to_wallet_id', $wallet->id)
            ->where('user_id', $user)
            ->sum('amount');
            $transferOut = Transfer::where('wallet_id', $wallet->id)
            ->where('user_id', $user)
            ->sum('amount');
            
            $wallet->remainingBalance = ($incomeAmount - $expenseAmount) + ($transferIn - $transferOut);
            return $wallet;
        });
        $categories = category::whereNull('user_id')->orWhere('user_id', $user)->get();
        $tags = tag::whereNull('user_id')->orWhere('user_id', $user)->get();
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

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|date',
            'wallet_id' => 'required',
            'user_id'=>'required',
            'amount' => 'required|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $wallet = Wallet::findOrFail($request->wallet_id);
        $incomeAmount = Transaction::where('wallet_id', $wallet->id)
            ->whereHas('transactionType', function ($query) {
                $query->where('name', 'Income');
            })
            ->sum('amount');

        $expenseAmount = Transaction::where('wallet_id', $wallet->id)
            ->whereHas('transactionType', function ($query) {
                $query->where('name', 'Expense');
            })
            ->sum('amount');

        $transferIn = Transfer::where('to_wallet_id', $wallet->id)->sum('amount');
        $transferOut = Transfer::where('wallet_id', $wallet->id)->sum('amount');

        $remainingBalance = ($incomeAmount - $expenseAmount) + ($transferIn - $transferOut);

        if ($request->amount > $remainingBalance) {
            return redirect()->back()->withErrors(['amount' => 'The balance is not enough'])->withInput();;
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
        $user = Auth::user()->id;
        $filterType = $request->input('filterType');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        
        $query = Transaction::where('transaction_type_id', 4)->where('user_id', $user)->orderBy('date', 'desc');
    
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
                    $query->whereBetween('date', [$startDate, $endDate]);
                } elseif ($startDate) {
                    $query->where('date', '>=', $startDate);
                } elseif ($endDate) {
                    $query->where('date', '<=', $endDate);
                }
                break;
        }
    
        $transactions = $query->get();
        $expenseAmount = $query->sum('amount');
    
        // chart data
        $data = $transactions->groupBy('category.name')->map(function ($transactions, $category) {
            return [
                'category' => $category,
                'amount' => $transactions->sum('amount')
            ];
        })->values();
    
        return view('pages.expense.detail', compact('transactions', 'expenseAmount', 'filterType', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user()->id;
        $transaction = Transaction::find($id);
        $wallets = Wallet::whereNull('user_id')->orWhere('user_id', $user)->get()->map(function ($wallet) {
            $incomeAmount = Transaction::where('wallet_id', $wallet->id)
                ->whereHas('transactionType', function ($query) {
                    $query->where('name', 'Income');
                })
                ->sum('amount');
    
            $expenseAmount = Transaction::where('wallet_id', $wallet->id)
                ->whereHas('transactionType', function ($query) {
                    $query->where('name', 'Expense');
                })
                ->sum('amount');

            $user = Auth::user()->id;
            $transferIn = Transfer::where('to_wallet_id', $wallet->id)
            ->where('user_id', $user)
            ->sum('amount');
            $transferOut = Transfer::where('wallet_id', $wallet->id)
            ->where('user_id', $user)
            ->sum('amount');
            
            $wallet->remainingBalance = ($incomeAmount - $expenseAmount) + ($transferIn - $transferOut);
            return $wallet;
        });
        $categories = category::whereNull('user_id')->orWhere('user_id', $user)->get();
        $tags = tag::whereNull('user_id')->orWhere('user_id', $user)->get();
        $transactionType = TransactionType::all();
        $transactionName = $transactionType->firstWhere('id', 4)->name;
        $transactionid = $transactionType->firstWhere('id', 4)->id;
        return view('pages.expense.edit', compact('id','transaction', 'wallets', 'categories', 'tags', 'transactionType', 'transactionName', 'transactionid', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = transaction::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|date',
            'wallet_id' => 'required',
            'user_id'=>'required',
            'amount' => 'required|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $wallet = Wallet::findOrFail($request->wallet_id);
        $incomeAmount = Transaction::where('wallet_id', $wallet->id)
            ->whereHas('transactionType', function ($query) {
                $query->where('name', 'Income');
            })
            ->sum('amount');

        $expenseAmount = Transaction::where('wallet_id', $wallet->id)
            ->whereHas('transactionType', function ($query) {
                $query->where('name', 'Expense');
            })
            ->sum('amount');

        $transferIn = Transfer::where('to_wallet_id', $wallet->id)->sum('amount');
        $transferOut = Transfer::where('wallet_id', $wallet->id)->sum('amount');

        $remainingBalance = ($incomeAmount - $expenseAmount) + ($transferIn - $transferOut);

        if ($request->amount > $remainingBalance) {
            return redirect()->back()->withErrors(['amount' => 'The balance is not enough'])->withInput();;
        }

        $transaction->update([
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('home.index')->with('success', 'Transaction deleted successfully');
    }
}
