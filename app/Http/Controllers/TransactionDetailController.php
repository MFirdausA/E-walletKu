<?php

namespace App\Http\Controllers;

use App\Models\PlannedPayment;
use App\Models\Transaction;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPUnit\Event\Tracer\Tracer;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionDetailController extends Controller
{
    // public function TransactionDetail(Request $request)
    // {
    //     $from = $request->from;
    //     $type = $request->type;

    //     if (!$from || !$type) {
    //         return redirect()->route('home.index')->with('error', 'Transaction not found');
    //     }
        
    //     $transaction= Transaction::find($request->id);

    //     if (!$transaction) {
    //         $transaction = Transfer::find($request->id);
    //     }
    //     $plannedPayment = PlannedPayment::with('status')->find($request->id);
    //     $status = $plannedPayment->status;  

    //     if (!$transaction) {
    //         $transaction = PlannedPayment::with(['plannedType', 'repeatType', 'status'])->find($request->id);
    //     }
    //     // dd($transaction);
    
    //     if (!$transaction) {
    //         return redirect()->route('home.index')->with('error', 'Transaction not found');
    //     }
    //     return view('pages.transaction-detail', compact('transaction', 'from','type', 'status'));
    // }

    public function TransactionDetail(Request $request)
    {
        $from = $request->from;
        $type = $request->type;
        $id = $request->id;
        $status = null;

        if (!$from || !$type || !$id) {
            return redirect()->route('home.index')->with('error', 'Transaction not found');
        }

        // Handle each transaction type separately
        switch ($type) {
            case 'Income':
            case 'Expense':
                $transaction = Transaction::with(['category', 'wallet', 'tag', 'transactionType'])
                    ->where('id', $id)
                    ->first();
                break;
                
            case 'Transfer':
                $transaction = Transfer::with(['category', 'wallet', 'tag', 'transactionType'])
                    ->where('id', $id)
                    ->first();
                break;
                
            case 'Planned':
                $transaction = PlannedPayment::with([
                    'category', 
                    'wallet',  
                    'transactionType',
                    'plannedType',
                    'repeatType',
                    'status'
                ])->where('id', $id)->first();
                
                if ($transaction) {
                    $status = $transaction->status;
                }
                break;
                
            default:
                return redirect()->route('home.index')->with('error', 'Invalid transaction type');
        }

        if (!$transaction) {
            return redirect()->route('home.index')->with('error', 'Transaction not found');
        }

        return view('pages.transaction-detail', compact('transaction', 'from', 'type', 'status'));
    }

    public function TransactionSave($id)
    {
        $transaction= Transaction::find($id);
        $filename = 'receipt_'.$transaction->id.'_'.time().'.pdf';
        $path = storage_path('app/public/receipts/'.$filename);

        $pdf = Pdf::loadView('pages.transaction-save', compact('transaction'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions(['defaultFont' => 'poppins']);
        $pdf->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
        // return view('pages.transaction-save', compact('transaction','id'));
    }
}
