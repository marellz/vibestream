<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfileResource extends UserResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $me = Auth::id();
        $profile = $this->profile;
        $following = $me && $me !== $this->id ? [
            'is_following' => $this->followers->pluck('id')->contains($me),
            'is_followed_by' => $this->following->pluck('id')->contains($me),
        ] : [];

        return array_merge([
            'is_me' => $this->id === $me,
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'bio' => $this->bio,
            'gender' => $this->gender,
            'verified' => $this->email_verified_at,
            'phone_number' => $this->phone_number,
            'avatar' => $this->avatar ? asset($this->avatar) : null,

            #profile
            'title' => $profile->title,
            'cover_photo' => $profile->cover_photo,
            'date_of_birth' => $profile->date_of_birth,
            'location' => $profile->location,
            'website' => $profile->website,
            'social_urls' => $profile->social_urls,
            'phone_number_alt' => $profile->phone_number_alt,
            'occupation' => $profile->occupation,
            'education' => $profile->education,
            'information' => $profile->information,
            'status' => $profile->status,
            'date_of_birth' => $profile->date_of_birth,
            'social_urls' => $profile->social_urls,
            'location' => $profile->location,
            'followers_count' => $this->followers->count(),
            'following_count' => $this->following->count(),
        ], $following);
    }
}
