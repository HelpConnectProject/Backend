<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'organization_id',
        'title',
        'description',
        'location',
        'date',
        'capacity',
    ];

    protected $casts = [
        'date' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    
    protected static function booted()
    {
        static::saving(function (Event $event) {
            $event->setStatusByDate();
        });

        static::retrieved(function ($event) {
            $originalStatus = $event->status;

            $event->setStatusByDate();

            if ($event->status !== $originalStatus) {
                $event->saveQuietly();
            }
        });
    }

    public function setStatusByDate()
    {
        if ($this->date && \Carbon\Carbon::now() > $this->date) {
            $this->status = 'Inaktív';
        } else {
            $this->status = 'Aktív';
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
