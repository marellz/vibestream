<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowerRequest;
use App\Http\Requests\UpdateFollowerRequest;
use App\Http\Services\FollowService;
use App\Http\Services\ProfileService;
use App\Http\Services\UsersService;
use App\Models\Follower;
use App\Models\User;
use Exception;

class FollowerController extends Controller
{

    public function __construct(
        private readonly UsersService $service,
        private readonly FollowService $followService,
    ) {
        $this->middleware('auth:api', ['except' => ['followers', 'following']]);
    }

    public function suggestions()
    {
        $data['following'] = $this->followService->suggestions(auth()->user());
        return $this->respond($data);
    }

    public function followers(User $user)
    {
        $data['followers'] = $this->followService->followers($user);
        return $this->respond($data);
    }

    public function following(User $user)
    {
        $data['following'] = $this->followService->following($user);
        return $this->respond($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        $data['success'] = $this->followService->follow($user);
        return $this->respond($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $data['success'] = $this->followService->unfollow($user);
        return $this->respond($data);
    }
}
