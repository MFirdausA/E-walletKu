<?php

namespace App\Http\Controllers;

use App\Models\tag;
use App\Models\wallet;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\plannedPayment;
use App\Models\repeatType;
use App\Models\status;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlannedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plannedPayments = plannedPayment::all();
        $amount = plannedPayment::sum('amount');
        return view('pages.planned-payment.index', compact(
            'plannedPayments',
            'amount'
        ));
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
        $status = status::firstWhere('id', 1)->id;
        // dd($status);
        $repeatTypes = repeatType::all();
        $transactionType = TransactionType::all();
        $plannedIncome = $transactionType->firstWhere('id', 5)->name;
        $plannedExpense = $transactionType->firstWhere('id', 1)->name;
        $transactionName = $transactionType->firstWhere('id', 6)->name;
        return view('pages.planned-payment.create', compact(
        'wallets', 
        'categories', 
        'tags', 
        'transactionType', 
        'transactionName', 
        'plannedIncome', 
        'plannedExpense', 
        'user', 
        'repeatTypes',
        'status'
    ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'start_date' => 'required|date',
            'transaction_type_id' => 'required',
            'wallet_id' => 'required',
            'amount' => 'required',
            'category_id' => 'required',
            'status_id' => 'required',
            'repeat_type_id' => 'required',
            'repeat_count' => 'required|min:1',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        plannedPayment::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'transaction_type_id' => $request->transaction_type_id,
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'repeat_type_id' => $request->repeat_type_id,
            'repeat_count' => $request->repeat_count,
            'user_id' => $request->user_id,
        ]);
        return redirect()->route('home.index');
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
