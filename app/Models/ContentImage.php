<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentImage extends Model
{
    use HasFactory;
    protected $table="content_images";
    protected $guarded=[];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
