<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
    'title',
    'description', 
    'date', 
    'status_id', 
    'loantype_id', 
    'wallet_id', 
    'amount', 
    'user_id'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function loanType()
    {
        return $this->belongsTo(LoanType::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
