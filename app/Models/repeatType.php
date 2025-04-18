<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepeatType extends Model
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
        return $this->hasMany(PlannedPayment::class , 'repeat_type_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
