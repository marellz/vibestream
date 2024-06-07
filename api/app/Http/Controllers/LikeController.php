<?php

namespace App\Http\Controllers;

use App\Http\Services\LikeService;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //

    public function __construct(
        private readonly LikeService $service
    )
    {
        $this->middleware('auth:api');
    }


    public function store(Request $request)
    {
        $user_id = Auth::id();
        $data = $this->service->toggle($user_id, $request);

        return $this->respond($data);
    }
}
