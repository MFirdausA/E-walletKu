<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'name', 
    'user_id'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plannedPayments()
    {
        return $this->hasMany(PlannedPayment::class, 'status_id');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'status_id');
    }
}
