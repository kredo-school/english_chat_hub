<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    // RELATION
    public function eventLevel()
    {
        return $this->belongsToMany(Level::class, 'event_level');
    }
    public function joinEvent()
    {
        return $this->belongsToMany(Participant::class, 'join_event');
    }

}
