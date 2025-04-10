<?php

namespace App\Http\Controllers;

use App\Models\plannedPayment;
use App\Models\transaction;
use App\Models\transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPUnit\Event\Tracer\Tracer;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionDetailController extends Controller
{
    public function TransactionDetail(Request $request)
    {
        $from = $request->from;
        $type = $request->type;

        if (!$from || !$type) {
            return redirect()->route('home.index')->with('error', 'Transaction not found');
        }
        
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

    public function TransactionSave($id)
    {
        $transaction= Transaction::find($id);
        $filename = 'receipt_'.$transaction->id.'_'.time().'.pdf';
        $path = storage_path('app/public/receipts/'.$filename);

        $pdf = Pdf::loadView('pages.transaction-save', compact('transaction'));
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOptions(['defaultFont' => 'poppins']);
        $pdf->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
        // return view('pages.transaction-save', compact('transaction'));
    }
}
