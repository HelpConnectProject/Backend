<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    protected $fillable = [
        'user_id',
        'interest',
        'qualification',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
