<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FileUploadService
{
    public function user ()
    {
        return User::find(Auth::id());
    }

    public function upload ($file, $dest = 'uploads')
    {
        $url = $file->store($dest);
        return $this->user()->update([
            'avatar'=>$url,
        ]);
    }
}
