<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    // RELATION
    public function eventLevels()
    {
        return $this->belongsToMany(Level::class, 'event_level');
    }

    public function getEventString() {
        $eventString = '';
        $eventLevels = $this->eventLevels;
        foreach($eventLevels as $key => $event) {
            $comma = ($key != ($eventLevels->count() - 1)) ? ', ' : '';
            $name = ucfirst($event->name);
            $eventString .= "{$name} {$comma}";
        }

        return $eventString;
    }

    public function joinEvents()
    {
        return $this->belongsToMany(Participant::class, 'join_event');
    }

}
