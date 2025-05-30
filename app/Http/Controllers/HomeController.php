<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Transfer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PlannedPayment;
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
        // dd($allTransactions);
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = Transaction::where('transaction_type_id', $income->id)
            // ->whereMonth('date', Carbon::now('Asia/Jakarta')->month)
            ->where('user_id', $user)
            ->sum('amount');
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = Transaction::where('transaction_type_id', $expense->id)
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
        
        // Base queries
        $transactionQuery = Transaction::where('user_id', $user);
        $transferQuery = Transfer::where('user_id', $user);
        $plannedPaymentQuery = PlannedPayment::where('user_id', $user);

        // Apply filters to each query
        switch ($filterType) {
            case 'daily':
                $transactionQuery->whereDate('date', Carbon::today('Asia/Jakarta'));
                $transferQuery->whereDate('date', Carbon::today('Asia/Jakarta'));
                $plannedPaymentQuery->whereDate('start_date', Carbon::today('Asia/Jakarta'));
                break;
            case 'weekly':
                $transactionQuery->whereBetween('date', [
                    Carbon::now('Asia/Jakarta')->startOfWeek(),
                    Carbon::now('Asia/Jakarta')->endOfWeek()
                ]);
                $transferQuery->whereBetween('date', [
                    Carbon::now('Asia/Jakarta')->startOfWeek(),
                    Carbon::now('Asia/Jakarta')->endOfWeek()
                ]);
                $plannedPaymentQuery->whereBetween('start_date', [
                    Carbon::now('Asia/Jakarta')->startOfWeek(),
                    Carbon::now('Asia/Jakarta')->endOfWeek()
                ]);
                break;
            case 'monthly':
                $transactionQuery->whereMonth('date', Carbon::now('Asia/Jakarta')->month);
                $transferQuery->whereMonth('date', Carbon::now('Asia/Jakarta')->month);
                $plannedPaymentQuery->whereMonth('start_date', Carbon::now('Asia/Jakarta')->month);
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $transactionQuery->whereBetween('date', [$startDate, $endDate]);
                    $transferQuery->whereBetween('date', [$startDate, $endDate]);
                    $plannedPaymentQuery->whereBetween('start_date', [$startDate, $endDate]);
                } elseif ($startDate) {
                    $transactionQuery->where('date', '>=', $startDate);
                    $transferQuery->where('date', '>=', $startDate);
                    $plannedPaymentQuery->where('start_date', '>=', $startDate);
                } elseif ($endDate) {
                    $transactionQuery->where('date', '<=', $endDate);
                    $transferQuery->where('date', '<=', $endDate);
                    $plannedPaymentQuery->where('start_date', '<=', $endDate);
                }
                break;
        }

        $transactions = $transactionQuery->orderBy('date', 'desc')->get();
        $transfers = $transferQuery->orderBy('date', 'desc')->get();
        $plannedPayments = $plannedPaymentQuery->with('status')
            ->orderBy('start_date', 'asc')
            ->get();

        $allTransactions = $transactions->concat($transfers)->concat($plannedPayments);

        $income = TransactionType::where('name', 'Income')->first();
        $incomeAmount = $transactions->where('transaction_type_id', $income->id)->sum('amount');
        
        $expense = TransactionType::where('name', 'Expense')->first();
        $expenseAmount = $transactions->where('transaction_type_id', $expense->id)->sum('amount');
        
        $amount = $incomeAmount - $expenseAmount;

        $upcomingPayments = $plannedPayments->where('status.name', 'Upcoming');
        $overduePayments = $plannedPayments->where('status.name', 'Overdue');
        $categoryTransaction = Category::pluck('name');
        $dateFormat = Carbon::now()->format('F d');
        $dateOfDay = Carbon::now()->format('l');

        return view('pages.home', [
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

    public function payPlanned(Request $request, string $id)
    {
        $transaction = PlannedPayment::find($id);

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
        $transaction = PlannedPayment::find($id);

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
