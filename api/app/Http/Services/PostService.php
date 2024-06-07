<?php

namespace App\Http\Services;

use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\StorePostRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostService
{
    public function all(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::latest()->get());
    }

    public function findById(string $id): Post
    {
        return Post::findOrFail($id);
    }

    public function get($id)
    {
        $post = $this->findById($id);
        return new PostResource($post);
    }

    public function create(StorePostRequest $request): PostResource
    {
        $validated = $request->safe()->only([
            'user_id',
            'content'
        ]);

        $post = Post::create($validated);
        return new PostResource($post);
    }

    public function update(string $id, UpdatePostRequest $request): bool
    {
        $post = $this->findById($id);
        return $post->update(
            $request->safe()->only([
                'user_id',
                'content',
            ])
        );
    }

    public function delete(string $id): bool
    {
        $post = $this->findById($id);
        return $post->delete();
    }



    // Actions

    public function like(string $id)
    {
        $post = $this->findById($id);
        $post->update([
            'likes' => $post->likes += 1,
        ]);
    }

    public function unlike(string $id)
    {
        $post = $this->findById($id);
        $post->update([
            'likes' => $post->likes = 1,
        ]);
    }
}
