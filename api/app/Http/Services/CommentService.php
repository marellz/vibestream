<?php

namespace App\Http\Services;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentService
{
    public function all($id): AnonymousResourceCollection
    {
        return CommentResource::collection(Comment::where('post_id', $id)->get());
    }

    public function findById(string $id): Comment
    {
        return Comment::findOrFail($id);
    }

    public function get(string $id): CommentResource
    {
        return new CommentResource($this->findById($id));
    }

    public function create(StoreCommentRequest $request): CommentResource
    {
        $comment =
        Comment::create(
            $request->safe()->only([
                'user_id',
                'post_id',
                'content',
            ])
        );
        return new CommentResource($comment);
    }
    // public function update(string $id, UpdateCommentRequest $request): bool
    // {
    //     $comment = $this->get($id);
    //     return $comment->update(
    //         $request->safe()->only([
    //             ''
    //         ])
    //     );
    // }

    public function delete(string $id): bool
    {
        $comment = $this->get($id);
        return $comment->delete();
    }
}
