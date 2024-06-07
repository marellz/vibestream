<?php

namespace App\Http\Services;

use App\Http\Resources\LikeResource;
use App\Models\User as Model;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class LikeService
{
    public function all(): Collection
    {
        return Model::all();
    }

    public function get(string $id): Model
    {
        return Model::findOrFail($id);
    }

    public function toggle (int $user_id, Request $request)
    {
        $post_id = $request->post_id;
        $liked = Like::where('post_id', $post_id)->where('user_id', $user_id);
        if ($liked->exists()) {
            // delete
            $liked->delete();
            $response['liked'] = false;
        } else {
            // like this post
            $response['liked'] = true;
            $request->merge(['user_id' => $user_id]);
            $data = $request->only(['post_id', 'user_id']);
            Like::create($data);
        }

        $response['likes'] = Like::where('post_id', $post_id)->count();

        return new LikeResource($response);
    }

}
