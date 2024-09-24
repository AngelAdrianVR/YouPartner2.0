<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Claim extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'status',
        'refund',
        'collaboration_id',
        'description',
        'solution_details',
        'solution',
    ];

     // Relationships -------------------
     public function collaboration()
     {
         return $this->belongsTo(Collaboration::class);
     }
}
