<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user()->id;

        $filterType = $request->input('filterType'); //bisa tambahin default value '','value'
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
    
        $incomeType = TransactionType::where('name', 'Income')->first();
        $expenseType = TransactionType::where('name', 'Expense')->first();
    
        $query = Transaction::query()->where('user_id', $user);
    
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
            // case 'yearly':
            //     $query->whereYear('date', Carbon::now('Asia/Jakarta')->year);
            //     break;
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
    
        $incomeAmount = (clone $query)->where('transaction_type_id', $incomeType->id)->where('user_id', $user)->sum('amount');
        $expenseAmount = (clone $query)->where('transaction_type_id', $expenseType->id)->where('user_id', $user)->sum('amount');
        $totalAmount = $incomeAmount - $expenseAmount;
    
        // Grouping data for charts
        $incomeData = (clone $query)->where('transaction_type_id', $incomeType->id)
            ->where('user_id', $user)
            ->get()
            ->groupBy('category.name')
            ->map(function ($transactions, $category) {
                return [
                    'category' => $category,
                    'amount' => $transactions->sum('amount')
                ];
            })->values();
    
        $expenseData = (clone $query)->where('transaction_type_id', $expenseType->id)
            ->where('user_id', $user)
            ->get()
            ->groupBy('category.name')
            ->map(function ($transactions, $category) {
                return [
                    'category' => $category,
                    'amount' => $transactions->sum('amount')
                ];
            })->values();
    
        return view('pages.report.index', compact('incomeAmount', 'expenseAmount', 'totalAmount', 'incomeData', 'expenseData', 'filterType'));
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
