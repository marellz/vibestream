<?php

namespace App\Http\Services;

use App\Http\Resources\FollowerResource;
use App\Http\Resources\UserProfileResource;
use App\Models\Follower;
use App\Models\User;
use App\Rules\NoIdenticalFollow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FollowService {

    public function getUserInfo(User $user)
    {
        return $user->with(['followers', 'profile'])->first();
    }

    public function suggestions (User $user)
    {
        // todo: get users according to interests
        return User::inRandomOrder()->limit(15)->get();
    }

    public function followers(User $user)
    {
        $followers = $user->followers->load(['followers', 'following']);
        return FollowerResource::collection($followers);
    }

    public function following(User $user)
    {
        $following = $user->following->load(['followers','following']);
        return FollowerResource::collection($following);
    }

    public function follow(User $user)
    {
        $request = new Request();
        $request->merge([
            'user_id' => $user->id,
            'follower_id' => Auth::id(),
        ]);

        $data = $request->validate([
            'follower_id' => ['required', 'integer', 'exists:users,id'],
            'user_id' => ['required', 'integer', 'exists:users,id', new NoIdenticalFollow]
        ]);

        $newFollow = Follower::create($data);
        return $newFollow->exists();
    }

    public function unfollow(User $user)
    {
        return Follower::where('user_id', $user->id)
            ->where('follower_id', Auth::id())
            ->delete() > 0;
    }
}