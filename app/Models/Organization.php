<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{

    use HasFactory;

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
