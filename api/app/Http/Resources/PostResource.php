<?php

namespace App\Http\Resources;

use App\Models\Like;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $created = Carbon::create($this->created_at);
        if(Auth::check()){
            $liked = Like::where('post_id', $this->id)->where('user_id', Auth::id())->first();
        } else {
            $liked = false;
        }
        return [
            "id" => $this->id,
            "likes" => $this->likes->count(),
            "comments" => CommentResource::collection($this->comments),
            "user" => $this->author,
            "content" => $this->content,
            "created" => $created->diffForHumans(),
            "liked" => $liked,
        ];
    }
}
