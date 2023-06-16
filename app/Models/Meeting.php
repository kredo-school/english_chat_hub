<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory, SoftDeletes;

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
        // Set Live Time
        $liveTime = [
            'date' => now()->format('Y-m-d'),
            'time' => now()->format('H')
        ];

        // Change Status id
        $checks = $this->where('status_id', '!=', 3)->get();
        if ($checks->count() != 0) {
            foreach ($checks as $check) {
                # Compare Date
                if ($check->date === $liveTime['date']) {
                    # Compare Time
                    if ($check->start_at == $liveTime['time']) {
                        $check->status_id = 2;
                    } elseif ($check->start_at < $liveTime['time']) {
                        $check->status_id = 3;
                    }
                } elseif ($check->date < $liveTime['date']) {
                    $check->status_id = 3;
                }
                $check->save();
            }
        }
    } 
    public function statusColor()
    {
        return $statusColor = [
            1 => 'warning',     //stand by
            2 => 'success',     //in session
            3 => 'secondary'    //done
        ];
    }
}
