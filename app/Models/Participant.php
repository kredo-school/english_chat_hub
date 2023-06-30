<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasFactory, SoftDeletes;

    // RELATION
    public function joinEvents()
    {
        return $this->belongsToMany(Event::class, 'join_event','participant_id','event_id');

    }

    protected $fillable = ['name','email'];

     // 全参加者を取得するスコープを定義
     public function scopeAllParticipants($query)
     {
         return $query->withTrashed();
     }

     public function user(): BelongsTo
     {
        return $this->belongsTo(User::class, 'user_id');
     }
 }

