<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventFeedback extends Model
{
    protected $fillable = [
        'user_id',
        'organization_id',
        'event_id',
        'rating',
        'comment',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
