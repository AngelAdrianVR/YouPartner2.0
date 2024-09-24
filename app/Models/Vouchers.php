<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'code',
        'used_at',
        'notes',
        'user_id',
    ];

    protected $dates = [
        'used_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
