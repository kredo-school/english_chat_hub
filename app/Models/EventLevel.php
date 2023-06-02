<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLevel extends Model
{
    use HasFactory;

    protected $table = 'event_level';
    protected $fillable = ['event_id', 'level_id'];
    public $timestamps = false;

    // RELATION
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
