<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'post_id' => $this->post_id,
            'user' => new UserResource($this->user),
            'title' => $this->title,
            'comments' => CommentResource::collection($this->comments()->take(5)->get()),
            'date' => $this->date,
            'created_at' => $this->created_at && $this->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a'),
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ],
        ];
    }

}
