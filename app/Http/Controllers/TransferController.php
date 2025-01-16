<?php

namespace App\Http\Controllers;

use App\Models\tag;
use App\Models\wallet;
use App\Models\category;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use App\Models\transfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
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
        $wallets = wallet::all();
        $user = Auth::user()->id;
        $categories = category::all();
        $tags = tag::all();
        $transactionType = TransactionType::all();
        $transactionName = $transactionType->firstWhere('id', 5)->name;
        return view('pages.transfer.create', compact('transactionType', 'transactionName', 'categories', 'tags', 'user', 'wallets'));
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
        ]);
        // dd($request->all());
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        transfer::create([
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
