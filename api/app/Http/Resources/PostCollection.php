<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'posts' => $this->collection,
            'links' => [
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'is_first_page' => $this->onFirstPage(),
                'is_last_page' => $this->onLastPage(),
                'last_page' => $this->lastPage(),
                'is_empty'=> $this->isEmpty(),
                'count' => $this->count(),
                'total' => $this->total(),
            ]
            
        ];
    }
}
