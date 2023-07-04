<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'title', 'date', 'start_at', 'room_id', 'level_id', 'category_id'];
    const STATUS = [
        'stand_by'      => ['id' => 1, 'color' => 'warning'],
        'in_session'    => ['id' => 2, 'color' => 'success'],
        'done'          => ['id' => 3, 'color' => 'secondary']
    ];
    const UNIT_MEETING_TIME = 45;   // minutes / 1 meeting
    const MEETING_OPEN_FROM = 15;   //minutes before

    // RELATION
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function joinMeetings()
    {
        return $this->belongsToMany(User::class, 'join_meeting');
    }

    // Update Status_id
    public function updateStatus()
    {
        // Get Compare time
        $currentTime = now();
        $checkMeetings = $this->where('status_id', '!=', self::STATUS['done']['id'])->get();

        // Change Status_id
        if ($checkMeetings->count() != 0) {
            foreach ($checkMeetings as $meeting) {
                $meetingTime = Carbon::parse($meeting->date . $meeting->start_at);
                $meetingOpenAt  = $meetingTime->copy()->subMinutes(self::MEETING_OPEN_FROM);
                $meetingEndAt   = $meetingTime->copy()->addMinutes(self::UNIT_MEETING_TIME);
                # Compare Time
                if ($meetingOpenAt <= $currentTime && $meetingEndAt >= $currentTime) {
                    $meeting->status_id = self::STATUS['in_session']['id'];
                } elseif ($meetingEndAt < $currentTime) {
                    $meeting->status_id = self::STATUS['done']['id'];
                }
                $meeting->save();
            }
        }
    }
    public function statusColor()
    {
        $statusColor = [];
        foreach (self::STATUS as $status) {
            $statusColor[$status['id']] = $status['color'];
        }
        return $statusColor;
    }
}
