<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zoom_meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'zoom_meeting_id',
        'zoom_join_url',
        'zoom_start_url',
        'zoom_meeting_id',
        'zoom_password',
    ];

    // RELATION
    public function meeting() {
        return $this->belongsTo(Meeting::class);
    }
}
