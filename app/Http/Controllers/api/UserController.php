<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Traits\ResponseTrait;
use App\Models\User;
use App\Services\RegisterService;
use App\Services\TokenService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\DeleteProfileRequest;



class UserController extends Controller
{
    use ResponseTrait;

    protected RegisterService $registerService;
    protected TokenService $tokenService;

    public function __construct(  RegisterService $registerService, TokenService $tokenService ) {

        $this->registerService = $registerService;
        $this->tokenService = $tokenService;
    }  
    
    public function getUsers() {
        $users = User::with(['organizationMemberships', 'qualifications'])->get();
        return $this->sendResponse($users, "");
    }
       

    public function register( RegisterRequest $request ) {

        $validated = $request->validated();

        return $this->registerService->create( $validated );
    }    

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        if ($user && Hash::check($validated['password'], $user->password)) {
            $token = $this->tokenService->generateToken($user);
            $data = [
                'id' => $user->id,
                'role' => $user->role,
                'token' => $token,
                'token_type' => 'Bearer',
            ];
            $membership = $user->organizationMemberships()->first();
            if ($membership) {
                $data['organization_member_role'] = $membership->role;
                $data['organization_id'] = $membership->organization_id;
            }
            return $this->sendResponse($data, "Login successful");
        }
        return $this->sendError("Invalid credentials", [], 401);
    }
    
    public function logout() {

        $user = auth( "sanctum" )->user();
        
        return $success = $this->tokenService->deleteToken( $user );
    }  

    // innen
    
    public function getOwnProfile(Request $request) {
        $user = $request->user();
        if (!$user) {
            return $this->sendError('Unauthenticated', [], 401);
        }
        // $user->loadMissing(['organizationMemberships', 'qualifications']);
        return $this->sendResponse($user, "Saját profil megjelenítve");
    }

    public function updateProfile(UpdateProfileRequest $request) {
        $user = $request->user();

        if (!$user) {
            return $this->sendError('Unauthenticated', [], 401);
        }

        $data = $request->validated();
        $user->update($data);
        return $this->sendResponse($user, "Profil frissítve");
    }

    public function deleteProfile(DeleteProfileRequest $request) {
        $user = $request->user();

        if (!$user) {
            return $this->sendError('Unauthenticated', [], 401);
        }

        $user->tokens()->delete();
        $user->delete();

        return $this->sendResponse(null, "Profil törölve");
    }

}
