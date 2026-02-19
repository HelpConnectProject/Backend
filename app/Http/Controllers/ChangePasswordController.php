<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    public function show(Request $request)
    {
        $token = (string) $request->query('token', '');
        $email = (string) $request->query('email', '');

        return view('auth.change_password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        $status = Password::broker()->reset(
            $credentials,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('password.reset.form', ['token' => $credentials['token'], 'email' => $credentials['email']])
                ->with('status', 'A jelszó sikeresen módosítva lett.');
        }

        return back()->withErrors(['email' => __($status)])->withInput($request->only('email'));
    }
}
