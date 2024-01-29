<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Comment;
use App\Models\PostComment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        
    ];

    protected $table="users";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function post_comments()
    {
        return $this->hasMany(PostComment::class);

    }

    protected function FirstName(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
               
                return ucfirst($value);
            }
        );
    }
    protected function MiddleName(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
               
               return ucfirst($value);
            }
        );
    }

    protected function LastName(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
               
               return ucfirst($value);
            }
        );
    }


}
