<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Image;
use App\Models\PostImage;
use App\Models\PostComment;
use App\Models\ContentImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Requests\Admin\DeletePostRequest;
use App\Http\Requests\Admin\StoreContentImageRequest;
use App\Http\Requests\Admin\StorePostContentRequest;
use App\Models\PostContent;

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
    private function storeImage($request, $post, $target)
    {
        $imageName = $request->file("image")->getClientOriginalName();
        $path = $request->file('image')->storeAs(
            'public/images',
            $imageName,
            'local'

        );
        if ($target == 'post') {
            $image = PostImage::create([
                "name" => $imageName,
                "path" => Config::get("app.url") . "/" . "storage/images/$imageName",
                "post_id" => $post->id,

            ]);
            return $image->path;
        }
        $image = ContentImage::create([
            "name" => $imageName,
            "path" => Config::get("app.url") . "/" . "storage/images/$imageName",
            "post_id" => $post->id,

        ]);
        return $image->path;
    }
    public function storeContentImage(StoreContentImageRequest $request, Post $post)
    {
        $target = 'content';
        $path = $this->storeImage($request, $post, $target);

        return response()->json([
            "success" => true,
            'path' => $path
        ], 200);
    }
    public function store(PostRequest $request)
    {
        $validated = $request->safe()->except(['image']);


        $post = Post::create($validated);
        $target = 'post';

        $this->storeImage($request, $post, $target);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response($post);
    }

    public function storePostContent(StorePostContentRequest $request)
    {
        $validated = $request->validated();
        PostContent::create($validated);
        return response()->json([
            "success" => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {

        $validated = $request->safe()->except(['image']);

        if ($request->file("image") != null) {
            $this->storePostImage($request, $post);
        }

        $post->update($validated);
        $post->save();

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */

    private function deletePostImage($post)
    {
        $postImage = PostImage::where("post_id", $post->id)->first();
        $postImageName = $postImage->name;
        Storage::disk("local")->delete("public/images/" . $postImageName);
    }
    private function deleteContentImages($post)
    {
        $contentImages = ContentImage::where("post_id", $post->id)->get();
        foreach ($contentImages as $image) {
            $imageName = $image->name;
            Storage::disk("local")->delete("public/images/" . $imageName);
        }
    }
    public function destroy(DeletePostRequest $request, Post $post)
    {

        $this->deletePostImage($post);
        $this->deleteContentImages($post);


        $post->delete();
        return response()->json([
            "success" => true
        ]);
    }
}
