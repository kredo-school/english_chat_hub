<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Participant;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'level_id',
        'full_name',
        'user_name',
        'email',
        'password',
        'avatar',
        'comment',
        'self_delete',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // RELATION
    public function level()
    {
        return $this->BelongsTo(Level::class);
    }
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
    public function joinMeetings()
    {
        return $this->belongsToMany(Meeting::class, 'join_meeting');
    }
    public function participant(Participant $participant)
    {
        return $participant->where('email', $this->email)->first();
        // User has participated events, return Participant Model
        // If user hasn't participated any events, return NULL
    }
}
