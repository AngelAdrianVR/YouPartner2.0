<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'homework_id'
    ];

    // Relationships -----------------------
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function homework()
    {
        return $this->belongsTo(Homework::class);
    }

    public function unreadMessages()
    {
        return $this->hasMany(Message::class)
            ->whereNull('read_at')
            ->where('user_id', '<>', auth()->id());
    }
}
