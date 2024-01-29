<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticUserResource extends JsonResource
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
            "user_name"=>$this->user_name,
            "first_name"=>$this->first_name,
            "middle_name"=>$this->middle_name,
            "last_name"=>$this->last_name,
            "email"=>$this->email,
            "posts"=>PostResource::collection($this->posts),
            "comments"=>CommentResource::collection($this->comments),
            "post_comments"=>PostComentResource::collection($this->post_comments),
            "token"=>$this->when(auth()->user(), function () {
               
                $token =$this->createToken($this->email);
                return $token->plainTextToken ;
            }),
           
        ];
    }
}
