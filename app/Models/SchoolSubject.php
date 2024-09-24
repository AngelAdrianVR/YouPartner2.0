<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

     // Relationships -------------------
     public function homework()
     {
         return $this->hasMany(Homework::class);
     }
}
