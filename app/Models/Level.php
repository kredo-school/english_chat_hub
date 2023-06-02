<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    // RERATIONS
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
    public function eventLevel()
    {
        return $this->hasMany(EventLevel::class);
    }
}
