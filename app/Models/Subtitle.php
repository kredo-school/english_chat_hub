<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subtitle extends Model
{
    use HasFactory, SoftDeletes;

    // RELATION
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
