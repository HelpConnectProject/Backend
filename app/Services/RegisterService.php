<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserQualification;
use Illuminate\Support\Facades\Hash;
use App\Traits\ResponseTrait;

class RegisterService {

    use ResponseTrait;

    public function __construct(){
    }

    public function create( array $data ) {

        $user = new User();
        $user->name = $data[ "name" ];
        $user->email = $data[ "email" ];

        // Optional profile fields
        $user->phone = $data["phone"] ?? null;
        $user->city = $data["city"] ?? null;
        $user->about = $data["about"] ?? null;

        $user->password = Hash::make( $data[ "password" ]);

        $user->save();

        
        UserQualification::create([
            'user_id' => $user->id,
            'interest' => $data['interest'] ?? null,
            'qualification' => $data['qualification'] ?? null,
            'experience' => $data['experience'] ?? null,
        ]);

        return $this->sendResponse( $user->name, "Sikeres regisztráció." );
    }
}
