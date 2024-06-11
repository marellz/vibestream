<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersService
{
    
    public function user ()
    {
        return User::find(Auth::id());
    }
    
    public function all() : AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function get(string $id) : UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    public function create(StoreUserRequest $request): UserResource
    {
        $user = User::create(
            $request->safe()->only([
                'name',
                'email',
                'password',
            ])
        );

        return new UserResource($user);
    }

    
    public function update(UpdateUserRequest $request) : bool
    {
        $user = $this->user();
        return $user->update(
            $request->safe()->only([
                'name',
                'email',
                'password',
            ])
        );
    }

    public function delete(string $id) : bool
    {
        $user = $this->get($id);
        return $user->delete();
    }

    public function deleteAvatar ()
    {
        $user = $this->user();
        $file = $user->avatar;
        if($file && Storage::exists($file)){
            Storage::delete($file);
        }

        $updated = $user->update(['avatar' => null]);

        return $updated;
    }
}
