<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\PostComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table="comments";
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_comment()
    {
        return $this->belongsTo(PostComment::class);
    }

   
   
}
