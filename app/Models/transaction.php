<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 
        'description', 
        'transaction_type_id', 
        'date', 
        'category_id', 
        'tag_id', 
        'wallet_id',
        'amount',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }

    public function tag()
    {
        return $this->belongsTo(tag::class, 'tag_id');
    }

    public function wallet()
    {
        return $this->belongsTo(wallet::class);
    }

    // public function transactionTypes()
    // {
    //     return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    // }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repeatType()
    {
        return $this->belongsTo(RepeatType::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
