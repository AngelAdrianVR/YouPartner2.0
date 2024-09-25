<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Homework extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'limit_date',
        'priority',
        'user_id',
        'school_subject_id'
    ];

    protected $casts = [
        'limit_date' => 'date'
    ];

    // Relationships -------------------
    public function schoolSubject()
    {
        return $this->belongsTo(SchoolSubject::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collaborations()
    {
        return $this->hasMany(Collaboration::class);
    }
    
    public function approvedCollaboration()
    {

        return $this->collaborations()->with('user', 'rate','claim')->whereNotNull('approved_at')->first();

    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    // methods
    public function status()
    {
        $collaboration_approved = $this->collaborations()->whereNotNull('approved_at');
        if ( !$collaboration_approved->get('id')->count() ) return 0; //no collaboration
        elseif ( !$collaboration_approved->WhereNotNull('completed_date')->get('id')->count() ) return 2; //in process
        elseif ( !$collaboration_approved->has('claim')->get('id')->count() ) return 3; //complete
        else return 4; //claim
    }

    // query scopes
    public function scopeFilter($query, $filters)
    {
        $query->when($filters["search"], function($query, $search){
            $query->where('title', 'LIKE', "%$search%")
                ->orWhereHas('schoolSubject', function($query2) use($search){
                    $query2->where('name', 'LIKE', "%$search%");
                })
                ->orWhereHas('user', function($query2) use($search){
                    $query2->where('name', 'LIKE', "%$search%");
                });
        });
    }

    // query scopes
    public function scopeNoCollaborationApproved($query, $collaboration_doesnt_applied_by_me = false)
    {
        $query->whereHas('collaborations', function ($q) use ($collaboration_doesnt_applied_by_me){
            $q->whereNull('approved_at')
                ->when($collaboration_doesnt_applied_by_me, function ($query) {
                    $query->where('user_id', '<>', auth()->id());
                });
        })->orDoesntHave('collaborations');
    }
}
