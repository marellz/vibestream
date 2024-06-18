<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfile\UpdateUserProfileRequest;
use App\Http\Services\ProfileService;
use App\Http\Services\UsersService;
use App\Models\UserProfile;
use App\Models\User;

class UserProfileController extends Controller
{

    public function __construct (
        private readonly UsersService $usersService,
        private readonly ProfileService $profileService,
    )
    {
        
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data['profile'] = $this->profileService->get($user);
        return $this->respond($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
