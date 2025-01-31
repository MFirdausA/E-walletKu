<?php

namespace App\Http\Controllers;

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
        return view('pages.income.create',compact('wallets', 'categories', 'tags', 'transactionType', 'transactionName', 'transactionid','user'));    
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
    public function show()
    {
        $transactions = transaction::where('transaction_type_id', 1)->get();
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = transaction::where('transaction_type_id', $income->id)->sum('amount');
        return view('pages.income.detail', compact('transactions', 'incomeAmount'));
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
