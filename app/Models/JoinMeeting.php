<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinMeeting extends Model
{
    use HasFactory;

    protected $table = 'join_meeting';
    protected $fillable = ['user_id', 'meeting_id'];
    public $timestamps = false;

    // RELATION
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
