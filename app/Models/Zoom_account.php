<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zoom_account extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'zoom_code',
        'access_token',
        'refresh_token',
        'zoom_expires_in'
    ];

    //RELATION
    public function room() {
        return $this->belongsTo(Room::class);
    }
}
