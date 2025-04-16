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

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user()->id;
        $wallets = wallet::all();
        $categories = category::all();
        $tags = tag::all();
        $transactionType = TransactionType::all();
        $transactionName = $transactionType->firstWhere('id', 1)->name;
        $transactionid = $transactionType->firstWhere('id', 1)->id;

        session(['transaction_type_id' => $transactionid, 'user_id' => $user]);
        return view('pages.income.create',compact('wallets', 'categories', 'tags', 'transactionType', 'transactionName', 'transactionid','user'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'transaction_type_id' => session('transaction_type_id'),
            'user_id' => session('user_id'),
        ]);
    
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
        return redirect()->route('home.index')->with('success', 'Transaction created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = Auth::user()->id;
        $from = $request->from;
        $filterType = $request->input('filterType');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
    
        $query = Transaction::where('transaction_type_id', 1)->where('user_id', $user)->orderBy('date', 'desc');
    
        switch ($filterType) {
            case 'daily':
                $query->whereDate('date', Carbon::today('Asia/Jakarta'));
                break;
            case 'weekly':
                $query->whereDate('date', '>=', Carbon::now('Asia/Jakarta')->startOfWeek())
                    ->whereDate('date', '<=', Carbon::now('Asia/Jakarta')->endOfWeek());
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
        $incomeAmount = $query->sum('amount');
    
        // chart data
        $data = $transactions->groupBy('category.name')->map(function ($transactions, $category) {
            return [
                'category' => $category,
                'amount' => $transactions->sum('amount')
            ];
        })->values();
    
        return view('pages.income.detail', compact('transactions', 'incomeAmount', 'filterType', 'data', 'from'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $transaction = Transaction::find($id);
        // dd($transaction->tag_id);
        $user = Auth::user()->id;
        $wallets = wallet::all();
        $categories = category::all();
        $tags = tag::all();
        $transactionType = TransactionType::all();
        $transactionName = $transactionType->firstWhere('id', 1)->name;
        $transactionid = $transactionType->firstWhere('id', 1)->id;
        return view('pages.income.edit', compact('id','transaction', 'wallets', 'categories', 'tags', 'transactionType', 'transactionName', 'transactionid', 'user'));
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
            'user_id' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
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
        
        return redirect()->route('home.index')->with('success', 'Transaction updated successfully')->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('home.index')->with('success', 'Transaction deleted successfully')->with('success', 'Transaction deleted successfully');
    }
}
