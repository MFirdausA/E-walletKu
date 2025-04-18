<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Status;
use App\Models\Wallet;
use App\Models\Category;
use App\Models\RepeatType;
use Illuminate\Http\Request;
use App\Models\PlannedPayment;
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
        $user = Auth::user()->id;
        $plannedPayments = PlannedPayment::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        $amount = PlannedPayment::where('user_id', $user)
            ->sum('amount');
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
        $wallets = Wallet::all();
        $categories = Category::all();
        $tags = Tag::all();
        $status = Status::firstWhere('id', 1)->id;
        // dd($status);
        $repeatTypes = RepeatType::all();
        $transactionType = TransactionType::all();
        $transactionid = $transactionType->firstWhere('id', 6)->id;
        $transactionName = $transactionType->firstWhere('id', 6)->name;
        return view('pages.planned-payment.create', compact(
        'wallets', 
        'categories', 
        'tags', 
        'transactionid',
        'transactionType', 
        'transactionName', 
        // 'plannedIncome', 
        // 'plannedExpense', 
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
            'planned_transaction_type_id' => 'required',
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

        $startDate = Carbon::parse($request->start_date)->timezone('Asia/Jakarta');
        $repeatTypes = $request->repeat_type_id;
        $repeatCount = $request->repeat_count;
        $userId = $request->user_id;

        for ($i = 0; $i < $repeatCount; $i++) {
            PlannedPayment::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $startDate,
                'transaction_type_id' => $request->transaction_type_id,
                'planned_transaction_type_id' => $request->planned_transaction_type_id,
                'wallet_id' => $request->wallet_id,
                'amount' => $request->amount,
                'category_id' => $request->category_id,
                'status_id' => $request->status_id,
                'repeat_type_id' => $request->repeat_type_id,
                'repeat_count' => $request->repeat_count,
                'user_id' => $request->user_id,
            ]);
        }

        if ($repeatTypes == 'Daily') {
            $startDate->addDay();
        } elseif ($repeatTypes == 'Weekly') {
            $startDate->addWeek();
        } elseif ($repeatTypes == 'Monthly') {
            $startDate->addMonth();
        } elseif ($repeatTypes == 'Yearly') {
            $startDate->addYear();
        }

        return redirect()->route('home.index')->with('success', 'Transaction created successfully');
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
        $plannedPayments = PlannedPayment::find($id);
        $user = Auth::user()->id;
        $wallets = Wallet::all();
        $categories = Category::all();
        $tags = Tag::all();
        $status = Status::firstWhere('id', 1)->id;
        // dd($status);
        $repeatTypes = RepeatType::all();
        $transactionType = TransactionType::all();
        $transactionid = $transactionType->firstWhere('id', 6)->id;
        $transactionName = $transactionType->firstWhere('id', 6)->name;
        return view('pages.planned-payment.edit', compact(
            'id',
            'plannedPayments',
            'wallets', 
            'categories', 
            'tags', 
            'transactionid',
            'transactionType', 
            'transactionName', 
            // 'plannedIncome', 
            // 'plannedExpense', 
            'user', 
            'repeatTypes',
            'status'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plannedPayments = PlannedPayment::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'start_date' => 'required|date',
            'transaction_type_id' => 'required',
            'planned_transaction_type_id' => 'required',
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
        $plannedPayments->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'transaction_type_id' => $request->transaction_type_id,
            'planned_transaction_type_id' => $request->planned_transaction_type_id,
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'repeat_type_id' => $request->repeat_type_id,
            'repeat_count' => $request->repeat_count,
            'user_id' => $request->user_id,
        ]);
        return redirect()->route('home.index')->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plannedPayments = PlannedPayment::find($id);
        $plannedPayments->delete();
        return redirect()->route('home.index')->with('success', 'Transaction deleted successfully');
    }
}
