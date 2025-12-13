<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    protected $fillable = [
        'organization_id',
        'user_id',
        'role',
    ];

    protected static function booted(): void
    {
        static::saving(function (OrganizationMember $member) {

            if (! in_array($member->role, ['owner', 'manager'], true)) {
                throw new \InvalidArgumentException('Érvénytelen szerep: csak owner vagy manager lehet.');
            }

            if ($member->role === 'owner') {
                $query = static::where('organization_id', $member->organization_id)
                    ->where('role', 'owner');

                if ($member->exists) {
                    $query->where('id', '!=', $member->id);
                }

                if ($query->exists()) {
                    throw new \RuntimeException('Egy szervezetnek csak egy owner-je lehet.');
                }
            }
        });
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
