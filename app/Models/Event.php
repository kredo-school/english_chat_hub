<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    // RELATION
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function eventLevel()
    {
        return $this->hasMany(EventLevel::class);
    }
    public function joinEvent()
    {
        return $this->belongsToMany(Participant::class, 'join_event');
    }

}
