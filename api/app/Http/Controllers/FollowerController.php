<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowerRequest;
use App\Http\Requests\UpdateFollowerRequest;
use App\Http\Services\ProfileService;
use App\Http\Services\UsersService;
use App\Models\Follower;
use App\Models\User;

class FollowerController extends Controller
{

    public function __construct(
        private readonly UsersService $service,
        private readonly ProfileService $profileService,
    )
    {
        $this->middleware('auth:api', ['except' => ['followers', 'following']]);
    }

    public function followers (string $username)
    {
        $data['followers'] = $this->profileService->followers($username);
        return $this->respond($data);
    }

    public function following (string $username)
    {
        $data['following'] = $this->profileService->following($username);
        return $this->respond($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        $data['success'] = $this->profileService->follow($user);
        return $this->respond($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $data['success'] = $this->profileService->unfollow($user);
        return $this->respond($data);
    }
}
