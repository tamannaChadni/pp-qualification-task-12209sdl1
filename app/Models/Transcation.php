<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcation extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcation_type',
        'amount',
        'sender',
        'reciver',
        'TXID',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function account()
    {
        return $this->hasOne(Account::class);
    }
}
