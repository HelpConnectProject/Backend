<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordChangedMail;

class PasswordChangeService
{
    public function change(User $user, string $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();
        Mail::to($user->email)->send(new PasswordChangedMail($user));
        return true;
    }
}
