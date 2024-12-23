<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    use HasFactory;

    protected $fillable = [
    'name', 
    'balance', 
    'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function plannedPayments()
    {
        return $this->hasMany(PlannedPayment::class);
    }
}
