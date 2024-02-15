<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\PostImage;
use App\Models\PostComment;
use App\Models\PostContent;
use App\Models\ContentImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table="posts";
    protected $guarded=[];

    public function post_comments()
    {
        return $this->hasMany(PostComment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->hasOne(PostImage::class);
    }
    public function content()
    {
        return $this->hasOne(PostContent::class);
    }
    public function content_images()
    {
        return $this->hasMany(ContentImage::class);
    }


}
