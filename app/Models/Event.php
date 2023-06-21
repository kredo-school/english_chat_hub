<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    // RELATION
    public function levels()
    {
        return $this->belongsToMany(Level::class, 'event_level');
    }

    public function getEventString()
    {
        $eventString = '';
        $levels = $this->levels;
        foreach ($levels as $key => $event) {
            $comma = ($key != ($levels->count() - 1)) ? "<br/>" : '';
            $name = ucfirst($event->name);
            $eventString .= "{$name} {$comma}";
        }
        return $eventString;
    }

    public function getEventStrComma()
    {
        $eventString = '';
        $levels = $this->levels;
        foreach ($levels as $key => $event) {
            $comma = ($key != ($levels->count() - 1)) ? " , " : '';
            $name = ucfirst($event->name);
            $eventString .= "{$name} {$comma}";
        }
        return $eventString;
    }

    public function joinEvents()
    {
        return $this->belongsToMany(Participant::class, 'join_event', 'event_id', 'participant_id')
            ->withTimestamps();

    }
    protected $fillable = ['theme'];
}
