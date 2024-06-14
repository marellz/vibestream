<?php

namespace App\Http\Services;

use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\Follower;
use App\Models\User;
use App\Models\UserProfile;
use App\Rules\NoIdenticalFollow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileService
{

    public function fields()
    {
        return [
            'user_id',
            'title',
            'cover_photo',
            'date_of_birth',
            'location',
            'website',
            'social_urls',
            'phone_number_alt',
            'occupation',
            'education',
            'information',
            'status',
            'date_of_birth' => 'datetime',
            'social_urls' => 'array',
            'location' => 'array'
        ];
    }

    public function getUserByUsername(string $username)
    {
        return User::where('username', $username)->firstOrFail();
    }

    public function get(string $username): UserProfileResource
    {
        $user = User::where('username', $username)->firstOrFail();
        return new UserProfileResource($user->profile);
    }

    public function create(StoreUserProfileRequest $request): UserProfile
    {
        return UserProfile::create(
            $request->safe()->only($this->fields())
        );
    }
    public function update(string $id, UpdateUserProfileRequest $request): bool
    {
        $UserProfile = $this->get($id);
        return $UserProfile->update(
            $request->safe()->only($this->fields())
        );
    }

    public function delete(string $id): bool
    {
        $UserProfile = $this->get($id);
        return $UserProfile->delete();
    }

    public function followers(string $username)
    {
        $user = $this->getUserByUsername($username);
        return UserProfileResource::collection($user->followers);
    }

    public function following(string $username)
    {
        $user = $this->getUserByUsername($username);
        return UserProfileResource::collection($user->following);
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
        // return $this->getUserByUsername($username)->following()->attach($following);
    }

    public function unfollow(User $user)
    {
    
        return Follower::where('user_id', $user->id)
            ->where('follower_id', Auth::id())
            ->delete() > 0;
        // return !! $user->following()->detach(Auth::id());/
    }
}
