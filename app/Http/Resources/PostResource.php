<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostResource extends Resource
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
            'slug' => $this->slug,
            'text' => $this->text,
            'type' => $this->type,
            'comments' => CommentResource::collection($this->comments()->take(5)->get()),
            'location' => $this->location,
            'date' => $this->date,
            'likes_count' => $this->likes()->count(),
            'comments_count' => $this->comments()->count(),
            'created_at' => $this->created_at && $this->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a'),

        ];
    }
}
