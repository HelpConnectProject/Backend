<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'organization_id',
        'title',
        'description',
        'location',
        'date',
        'status',
        'capacity',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(EventFeedback::class);
    }
}
