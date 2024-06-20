<?php

namespace App\Http\Services;

use App\Http\Resources\PostCollection;
use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class FeedService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function postsQuery()
    {
        return Post::with(['author', 'likes', 'comments']);
    }

    public function collect($posts)
    {
        return new PostCollection($posts);
    }

    public function myFollowing(int $id)
    {
        return Follower::where('follower_id', $id)->pluck('user_id');
    }

    public function posts()
    {
        $posts = $this->postsQuery()
            ->paginate();

        return $this->collect($posts);
    }

    public function friends(int $user)
    {

        $posts = $this->postsQuery()
            ->whereIn('user_id', $this->myFollowing($user))
            ->latest();

        return $this->collect($posts->paginate());
    }

    public function new(int $user)
    {
        $posts = $this->postsQuery()
            ->whereIn('user_id', $this->myFollowing($user))
            ->latest();

        return $this->collect($posts->paginate());
    }

    public function popular(int $user): PostCollection
    {
        $posts = $this->postsQuery()
            ->orderBy('comments_count', 'desc')
            ->orderBy('likes_count', 'desc')
            ->whereIn('user_id', $this->myFollowing($user));

        return $this->collect($posts->paginate());
    }
}
