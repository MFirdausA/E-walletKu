<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPUnit\Event\Tracer\Tracer;

class TransactionDetailController extends Controller
{
    public function TransactionDetail(Request $request)
    {
        $transaction= Transaction::find($request->id);
        return view('pages.transaction-detail', compact('transaction'));
    }

    public function TransactionSave(Request $request)
    {
        $transaction= Transaction::find($request->id);
        return view('pages.transaction-save', compact('transaction'));
    }
}
