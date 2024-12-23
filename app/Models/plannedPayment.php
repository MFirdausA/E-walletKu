<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class plannedPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transaction_type_id', 
        'title', 
        'category_id', 
        'status_id', 
        'description', 
        'start_date', 
        'end_date', 
        'repeat_type_id', 
        'repeat_count', 
        'next_interval', 
        'wallet_id', 
        'amount', 
        'user_id'
    ];

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function repeatType()
    {
        return $this->belongsTo(RepeatType::class);
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
