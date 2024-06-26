<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\UserProfile;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersService
{

    public function user()
    {
        return User::find(Auth::id());
    }

    public function fields ()
    {
        return [
            'name',
            'email',
            'password',
            'gender',
            'phone_number',
            'avatar',
            'bio',
        ];
    }

    public function all(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function get(string $id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    public function create(StoreUserRequest $request): User
    {
        $user = User::create(
            $request->validated()
        );

        UserProfile::create([
            'user_id' => $user->id,
        ]);

        return $user;
    }

    public function update(UpdateUserRequest $request): bool
    {
        $user = $this->user();
        return $user->update(
            $request->safe()->only($this->fields())
        );
    }

    public function delete(string $id): bool
    {
        $user = $this->get($id);
        return $user->delete();
    }

    public function deleteAvatar()
    {
        $user = $this->user();
        $file = $user->avatar;
        if ($file && Storage::exists($file)) {
            Storage::delete($file);
        }

        $updated = $user->update(['avatar' => null]);

        return $updated;
    }
}
