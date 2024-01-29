<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostComentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "id"=>$this->id,
            "Author"=>User::find($this->user_id),
            "post"=>new PostResource(Post::find($this->post_id)),
            "published_at"=>$this->published_at,
            "content"=>$this->content
          
           
          
        ];
    }
}
