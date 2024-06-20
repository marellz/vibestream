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
            $liked = $this->whenLoaded('likes')->pluck('user_id')->contains(auth()->id());
        } else {
            $liked = false;
        }
        $author = $this->whenLoaded('author')->only(['id','name','username','avatar']);
        return [
            "id" => $this->id,
            "likes" => $this->likes->count(),
            "content" => $this->content,
            "created" => $created->diffForHumans(),
            "liked" => $liked,
            "user" => $author,
            "comment_count" => $this->comments->count(),
        ];
    }
}
