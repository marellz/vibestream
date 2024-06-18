<?php

namespace App\Http\Services;

use App\Http\Requests\UserProfile\StoreUserProfileRequest;
use App\Http\Requests\UserProfile\UpdateUserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\Follower;
use App\Models\User;
use App\Models\UserProfile;
use App\Rules\NoIdenticalFollow;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function get(User $user)
    {
        if($user){
            $loaded = $user->load(['profile', 'followers', 'following']);
            return new UserProfileResource($loaded);
        } else {
            throw new NotFoundHttpException;
        }
    }

    public function create(StoreUserProfileRequest $request): UserProfile
    {
        return UserProfile::create(
            $request->safe()->only($this->fields())
        );
    }
    public function update(User $user, UpdateUserProfileRequest $request): bool | NotFoundHttpException
    {
        $userProfile = $user->profile;
        if(!$userProfile){
            throw new NotFoundHttpException();
        }
        return $userProfile->update(
            $request->safe()->only($this->fields())
        );
    }

    public function delete(User $user): bool | NotFoundHttpException
    {
        $userProfile = $user->profile;
        if($userProfile){
            return $userProfile->delete();
        } else {
            throw new NotFoundHttpException();
        }
    }
}
