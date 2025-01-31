<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'name',
    'cover', 
    'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class , 'transaction_type_id', 'id');
    }

    public function plannedPayments()
    {
        return $this->hasMany(PlannedPayment::class, 'transaction_type_id');
    }
}
