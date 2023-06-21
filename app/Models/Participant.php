<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use HasFactory, SoftDeletes;

    // RELATION
    public function joinEvents()
    {
        return $this->belongsToMany(Event::class, 'join_event','participant_id','event_id')
            ->withTimestamps();
    }

    protected $fillable = ['name','email'];


}
