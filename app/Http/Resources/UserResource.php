<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_id' => $this->id,
            'username' => $this->username,
            'u' => strtoupper($this->username[0]),
            'name' => $this->name,
            'avatar' => $this->avatar,
            'followers' => $this->followers,
            'following' => $this->following,
            'likes' => $this->likes
        ];
    }
}
