<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Wallet;
use App\Models\Category;
use App\Models\Transfer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        // $transfers = Transfer::where('user_id', $user)->get();
        $filterType = $request->input('filterType');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $query = Transfer::where('user_id', $user);
    
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

        $transfers = $query->get();
        // dd($transfers);
        return view('pages.transfer.index', compact('transfers', 'filterType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $from = $request->from;
        
        $wallets = Wallet::all();
        $user = Auth::user()->id;
        $categories = Category::all();
        $tags = Tag::all();
        $transactionType = TransactionType::all();
        $transactionId = $transactionType->firstWhere('id', 5)->id;
        $transactionName = $transactionType->firstWhere('id', 5)->name;
        return view('pages.transfer.create', compact('transactionType', 'transactionName' ,'transactionId', 'categories', 'tags', 'user', 'wallets', 'from'));
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
            'to_wallet_id' => 'required|different:wallet_id',
            'amount' => 'required',
            'fee' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
            'transaction_type_id' => 'required',
        ]);
        // dd($request->all());
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $amount = $request->amount;
        $fee = $request->fee;
        $totalAmount = $amount + $fee;

        Transfer::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'wallet_id' => $request->wallet_id,
            'to_wallet_id' => $request->to_wallet_id,
            'amount' => $request->amount,
            'fee' => $request->fee,
            'category_id' => $request->category_id,
            'tag_id' => $request->tag_id,
            'user_id' => $request->user_id,
            'transaction_type_id' => $request->transaction_type_id
        ]);
        return redirect()->route('home.index')->with('success', 'Transfer created successfully');
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
        $transaction = Transfer::find($id);
        $wallets = Wallet::all();
        $user = Auth::user()->id;
        $categories = Category::all();
        $tags = Tag::all();
        $transactionType = TransactionType::all();
        $transactionId = $transactionType->firstWhere('id', 5)->id;
        $transactionName = $transactionType->firstWhere('id', 5)->name;
        return view('pages.transfer.edit', compact('id','transaction', 'transactionType', 'transactionName' ,'transactionId', 'categories', 'tags', 'user', 'wallets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transfer::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|date',
            'wallet_id' => 'required',
            'to_wallet_id' => 'required|different:wallet_id',
            'amount' => 'required',
            'fee' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
            'transaction_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $amount = $request->amount;
        $fee = $request->fee;
        $totalAmount = $amount - $fee;

        $transaction->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'wallet_id' => $request->wallet_id,
            'to_wallet_id' => $request->to_wallet_id,
            'amount' => $request->amount,
            'fee' => $request->fee,
            'category_id' => $request->category_id,
            'tag_id' => $request->tag_id,
            'user_id' => $request->user_id,
            'transaction_type_id' => $request->transaction_type_id
        ]);
        return redirect()->route('home.index')->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transfer::find($id);
        $transaction->delete();
        return redirect()->route('home.index')->with('success', 'Transaction deleted successfully');
    }
}
