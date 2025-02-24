<?php

namespace App\Http\Controllers;

use App\Models\plannedPayment;
use App\Models\transaction;
use App\Models\transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPUnit\Event\Tracer\Tracer;

class TransactionDetailController extends Controller
{
    public function TransactionDetail(Request $request)
    {
        $from = $request->from;
        $type = $request->type;
        $transaction= Transaction::find($request->id);

        if (!$transaction) {
            $transaction = Transfer::find($request->id);
        }
    
        if (!$transaction) {
            $transaction = plannedPayment::find($request->id);
        }
    
        if (!$transaction) {
            return redirect()->route('home.index')->with('error', 'Transaction not found');
        }
        return view('pages.transaction-detail', compact('transaction', 'from','type'));
    }

    public function TransactionSave(Request $request)
    {
        $transaction= Transaction::find($request->id);
        return view('pages.transaction-save', compact('transaction'));
    }
}
