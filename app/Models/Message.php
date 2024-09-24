<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'chat_id',
        'read_at',
    ];

    protected $dates = [
        'read_at'
    ];

    // Relationships -------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    // query scopes
    public function scopeUnread($query, $type)
    {
        $query->whereIn('chat_id', auth()->user()->chats->pluck('id'))
            ->whereHas('chat', function ($q) use ($type) {
                $q->whereHas('homework', function ($q2) use ($type) {
                    $q2->when($type === 'homeworks', fn () => $q2->where('user_id', auth()->user()->id));
                    $q2->when($type === 'collaborations', fn () => $q2->where('user_id', '!=', auth()->user()->id));
                });
            })
            ->where('user_id', '!=', auth()->user()->id)
            ->whereNull('read_at');
    }
}
