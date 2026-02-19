<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordChangeService
{
    public function change(User $user, string $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();
        return true;
    }
}
