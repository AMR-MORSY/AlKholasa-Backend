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

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
      
       
   



          return PostResource::collection(Post::all());

    

        
    }

    /**
     * Store a newly created resource in storage.
     */

     private function storePostImage( $request, $post)
     {
        $imageName=$request->file("image")->getClientOriginalName();
        $path = $request->file('image')->storeAs(
            'public/images',$imageName,'local'
            
        );
        $image=Image::create([
            "name"=>$imageName,
            "path"=>Config::get("app.url")."/"."storage/images/$imageName",
            "post_id"=>$post->id,

        ]);


     }
    public function store(PostRequest $request)
    {
        
        $validated=$request->safe()->except(['image']);
       
      
        $post=Post::create($validated);

        $this->storePostImage($request,$post);
       
         return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return response($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
          
        $validated=$request->safe()->except(['image']);

        if($request->file("image")!=null)
        {
            $this->storePostImage($request,$post);
        }

        $post->update($validated);
        $post->save();

        return new PostResource($post);

        // return $request->input("published") ;


       
      
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Post $post)
    {
        $image=Image::where("post_id",$post->id)->first();
        $imageName=$image->name;
        Storage::disk("local")-> delete("public/images/".$imageName);
        $post->delete();
        return response()->json([
            "success"=>true
        ]);
    }
}
