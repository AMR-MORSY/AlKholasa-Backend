<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostComentResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
             "category"=>Category::find($this->category_id),
            "title"=>$this->title,
            "meta_title"=>$this->metaTitle,
            "slug"=>$this->slug,
            "summary"=>$this->summary,
            "published"=>$this->published,
            "published_at"=>$this->published_at,
            "content"=>$this->content,
            "views"=>$this->views,
            "image"=>$this->image,
            "comments"=>PostComentResource::collection($this->post_comments),
            "images"=>ImageResource::collection($this->images),


        ];
    }
}
