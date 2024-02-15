<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\FirstClass;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class UsersPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {

          return PostResource::collection(Post::all());
        
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

}
