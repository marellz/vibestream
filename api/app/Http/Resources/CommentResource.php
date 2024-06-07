<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
        return [
            "id" => $this->id,
            "post_id" => $this->post_id,
            "likes" => $this->likes,
            "user" => $this->author,
            "content" => $this->content,
            "created" => $created->diffForHumans(),
        ];
    }
}
