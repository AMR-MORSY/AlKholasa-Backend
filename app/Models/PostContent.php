<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostContent extends Model
{
    use HasFactory;

    protected $table="post_content";
    protected $guarded=[];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
