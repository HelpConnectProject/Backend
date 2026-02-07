<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    
    protected static function booted()
    {
        static::retrieved(function ($event) {
            
            if ($event->date && \Carbon\Carbon::now() > $event->date && $event->status !== 'Inaktív') {
                $event->status = 'Inaktív';
               
                $event->saveQuietly();
            }
        });
    }

    public function setStatusByDate()
    {
        if ($this->date && \Carbon\Carbon::now() > $this->date) {
            $this->status = 'Inaktív';
        } else {
            if ($this->status === 'Inaktív' || !$this->status) {
                $this->status = 'Aktív';
            }
        }
        return $this;
    }

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
