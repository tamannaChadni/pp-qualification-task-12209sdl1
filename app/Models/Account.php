<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'balance',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transcation()
    {
        return $this->belongsTo(Transcation::class);
    }


    // public function credit(int $balance)
    // {
    //     return $this->transaction()->create([
    //         'balance' => abs($balance),
    //     ]);
    // }

    // public function debit(int $balance)
    // {
    //     return $this->transaction()->create([
    //         'balance' => abs($balance) * -1,
    //     ]);
    // }
}
