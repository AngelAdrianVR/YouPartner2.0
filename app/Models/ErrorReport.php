<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ErrorReport extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'subject',
        'content',
        'user_id',
        'is_error',
        'is_read',
    ];

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // query scopes
    public function scopeFilter($query, $filters)
    {
        $query->when($filters["search"], function ($query, $search) {
            $query->where('subject', 'LIKE', "%$search%")
                ->orWhereHas('user', function ($query2) use ($search) {
                    $query2->where('name', 'LIKE', "%$search%");
                });
        });
    }
}
