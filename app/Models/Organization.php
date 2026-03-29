<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category',
        'phone',
        'address',
        'email',
        'website',
        'bank_account',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Organization $organization) {
            if ($organization->isForceDeleting()) {
                $organization->events()->withTrashed()->forceDelete();
                return;
            }

            $organization->events()->delete();
        });

        static::restoring(function (Organization $organization) {
            $organization->events()->withTrashed()->restore();
        });
    }

    public function members()
    {
        return $this->hasMany(OrganizationMember::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'organization_members')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function owner()
    {
        return $this->users()->wherePivot('role', 'owner');
    }

    public function managers()
    {
        return $this->users()->wherePivot('role', 'manager');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(EventFeedback::class);
    }
}
