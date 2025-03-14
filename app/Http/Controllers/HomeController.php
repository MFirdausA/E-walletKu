<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\category;
use App\Models\transfer;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\plannedPayment;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $transactions = Transaction::where('user_id', $user)
        // ->whereMonth('date', Carbon::now('Asia/Jakarta')->month)
        ->orderBy('date', 'desc')
        ->get();

        $transfers = Transfer::where('user_id', $user)
        ->orderBy('date', 'desc')
        ->get();

        $plannedPayments = PlannedPayment::where('user_id', $user)
        ->with('status')
        ->orderBy('start_date', 'asc')
        ->get();

        $upcomingPayments = $plannedPayments->where('status.name', 'Upcoming');
        $overduePayments = $plannedPayments->where('status.name', 'Overdue');

        $allTransactions = $transactions->concat($transfers)->concat($plannedPayments);
        $types = $transactions->map(function ($transaction) {
            return $transaction->transactionType->name;
        });
        // dd($types);
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = transaction::where('transaction_type_id', $income->id)
            // ->whereMonth('date', Carbon::now('Asia/Jakarta')->month)
            ->where('user_id', $user)
            ->sum('amount');
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = transaction::where('transaction_type_id', $expense->id)
            // ->whereMonth('date', Carbon::now('Asia/Jakarta')->month)
            ->where('user_id', $user)
            ->sum('amount');
        $amount = $incomeAmount - $expenseAmount;
        $categoryTransaction =  Category::pluck('name');
        $dateFormat =  carbon::now()->format('F d');
        $dateOfDay =  carbon::now()->format('l');
        return view('pages.home',[
        'user' => $user,
        'allTransactions' => $allTransactions,
        'amount' => $amount, 
        'incomeAmount' => $incomeAmount, 
        'expenseAmount' => $expenseAmount,
        'categoryTransaction' => $categoryTransaction,
        'dateFormat' => $dateFormat,
        'dateOfDay' => $dateOfDay,
        'plannedPayments' => $plannedPayments,
        'upcomingPayments' => $upcomingPayments,
        'overduePayments' => $overduePayments,
    ]);
    }

    public function filter(Request $request)
    {
    $user = Auth::user()->id;
    $filterType = $request->input('filterType');
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');
    
    $query = Transaction::query()->where('user_id', $user);

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
            } elseif ($startDate) {
                // Jika hanya startDate diisi, cari transaksi setelah atau pada startDate
                $query->where('date', '>=', $startDate);
            } elseif ($endDate) {
                // Jika hanya endDate diisi, cari transaksi sebelum atau pada endDate
                $query->where('date', '<=', $endDate);
            }
            break;
    }

        $transactions = $query->get();
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = $transactions->where('transaction_type_id', $income->id)->sum('amount');
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = $transactions->where('transaction_type_id', $expense->id)->sum('amount');
        $amount = $incomeAmount - $expenseAmount;
        $categoryTransaction =  Category::pluck('name');
        $dateFormat =  carbon::now()->format('F d');
        $dateOfDay =  carbon::now()->format('l');
    return view('pages.home', [
        'user' => $user,
        'transactions' => $transactions,
        'amount' => $amount,
        'incomeAmount' => $incomeAmount,
        'expenseAmount' => $expenseAmount,
        'categoryTransaction' => $categoryTransaction,
        'dateFormat' => $dateFormat,
        'dateOfDay' => $dateOfDay,
    ]);
    }

    public function payPlanned(Request $request, string $id)
    {
        $transaction = plannedPayment::find($id);

        if (!$transaction) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        $transaction->update(['status_id' => 3]); // Ganti dengan ID status "Complete"

        return response()->json([
            'message' => 'Payment marked as Complete',
            'payment' => $transaction
        ]);
    }

    public function skipPlanned(string $id)
    {
        $transaction = plannedPayment::find($id);

        if (!$transaction) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        $transaction->delete();
        return response()->json([
            'message' => 'Payment Skipped and deleted',
            'payment' => $transaction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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