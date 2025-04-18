<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
        return $this->hasMany(Transaction::class, 'category_id');
    }
    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }
    public function plannedPayments()
    {
        return $this->hasMany(PlannedPayment::class);
    }
}
