<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class FollowerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        $me = Auth::id();
        $following = $me && $me !== $this->id ? [
            'is_following' => $this->followers->pluck('id')->contains($me),
            'is_followed_by' => $this->following->pluck('id')->contains($me),
        ] : [];

        return array_merge([
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'avatar' => $this->avatar ? asset($this->avatar) : null,
        ], $following);
    }
}
