<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinEvent extends Model
{
    use HasFactory;

    protected $table = 'join_event';
    protected $fillable = ['participants_id', 'event_id'];
    public $timestamps = false;

    // RELATION
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
