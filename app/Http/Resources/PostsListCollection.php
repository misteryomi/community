<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostsListCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
        'data' => $this->collection,
        'pagination' => [
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage(),
            'has_more' => $this->hasMorePages(),
            'next_page_url' => $this->nextPageUrl()
        ],
    ];
    }

    public function toResponse($request)
    {
        return JsonResource::toResponse($request);
    }
}
