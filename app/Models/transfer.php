<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class transfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 
        'category_id', 
        'tag_id', 
        'description', 
        'date', 
        'wallet_id', 
        'to_wallet_id', 
        'fee', 
        'amount', 
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function toWallet()
    {
        return $this->belongsTo(Wallet::class, 'to_wallet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
