<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlannedPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 
        'description', 
        'start_date', 
        'transaction_type_id',
        'planned_transaction_type_id',
        'wallet_id', 
        'amount', 
        'category_id', 
        'status_id', 
        'repeat_type_id', 
        'repeat_count', 
        'user_id'
    ];

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class , 'transaction_type_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function repeatType()
    {
        return $this->belongsTo(RepeatType::class , 'repeat_type_id', 'id');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function plannedType()
    {
        return $this->belongsTo(TransactionType::class, 'planned_transaction_type_id', 'id');
    }
}
