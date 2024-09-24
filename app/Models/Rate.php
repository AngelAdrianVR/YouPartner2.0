<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'comments',
        'stars',
        'collaboration_id',
    ];

    // relationships
    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }
}
