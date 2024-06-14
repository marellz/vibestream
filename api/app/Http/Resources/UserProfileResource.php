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
        $user = User::find($this->id);

        if(Auth::check()){
            $me = Auth::user();
            $is_me = $user->is($me);

            $following = [
                'i_follow' => $user->followers->where('id', $me->id)->first() !== null,
                'follows_me' => $user->following->where('id', $me->id)->first() !== null,
            ];
        } else {
            $is_me = false;
            $following = [];
        } 
       
        return array_merge([
            'is_me'=> $is_me,
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'bio' => $user->bio,
            'gender' => $user->gender,
            'verified' => $user->email_verified_at,
            'phone_number' => $user->phone_number,
            'avatar' => $user->avatar ? asset($user->avatar) : null,

            'title' => $this->title,
            'cover_photo' => $this->cover_photo,
            'date_of_birth' => $this->date_of_birth,
            'location' => $this->location,
            'website' => $this->website,
            'social_urls' => $this->social_urls,
            'phone_number_alt' => $this->phone_number_alt,
            'occupation' => $this->occupation,
            'education' => $this->education,
            'information' => $this->information,
            'status' => $this->status,
            'date_of_birth' => $this->date_of_birth,
            'social_urls' => $this->social_urls,
            'location' => $this->location,
            'followerCount' => $user->followers->count(),
            'followingCount' => $user->following->count(),
        ], $following);
    }
}
