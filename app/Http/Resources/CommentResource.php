<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostComentResource;
use App\Models\PostComment;
use App\Models\User;
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
        return [
            "id"=>$this->id,
            "Author"=> User::find($this->user_id),
            "post_comment"=>new PostComentResource(PostComment::find( $this->post_comment_id)),
            "published_at"=>$this->published_at,
            "content"=>$this->content
        ];
    }
}
