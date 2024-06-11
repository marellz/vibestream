<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\User\Password\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\FileUploadService;
use App\Http\Services\UsersService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    public function __construct(
        private readonly UsersService $service,
        private readonly FileUploadService $fileUploadService
    ) {
        $this->middleware('auth:api');
    }

    public function show()
    {
        $data['user'] = new UserResource(Auth::user());
        return $this->respond($data);
    }


    public function update(UpdateUserRequest $request)
    {
        $data['updated'] = $this->service->update($request);
        return $this->respond($data);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        #Update the new Password
        $updated = User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $data['updated'] = $updated;
        $data['message'] = 'Password updated successfully';

        return $this->respond($data);
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $data['updated'] = $this->fileUploadService->upload($request->file('avatar'));
        return $this->respond($data);
    }

    public function deleteAvatar()
    {
        $data['deleted'] = $this->service->deleteAvatar();
        return $this->respond($data);
    }
}
