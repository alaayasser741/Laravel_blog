<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->latest();
        if (request('search')) {
            $posts = $posts->where('title', 'like', '%' . request('search') . '%');
        }
        $posts = $posts->latest()->paginate(2);
        return responseJson('success', 'Data Existing', PostResource::collection($posts)->paginate(2));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'categories' => 'required|array|exists:categories,id',
            'image' => 'require|image|mimes:png,jpg'
        ]);
        if ($validator->fails()) {
            return responseJson('error', 'validation Error', $validator->errors());
        } else {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('storage/posts'), $imageName);
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth('api')->id(),
                'image' => $imageName
            ]);
            $post->categories()->attach($request->categories);
            return responseJson('success', 'Post Added', new PostResource($post));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'categories' => 'required|array|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg'
        ]);
        if ($validator->fails()) {
            return responseJson('error', 'validation Error', $validator->errors());
        } else {
            if ($request->image) {
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('storage/posts'), $imageName);
                $post->update(['image' => $imageName]);
            }
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
            $post->categories()->sync($request->categories);
            return responseJson('success', 'Post Updated', new PostResource($post));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (file_exists(public_path($post->image_path))) {
            unlink(public_path($post->image_path));
        }
        $post->categories()->detach();
        $post->delete();
        return responseJson('success', 'Post Deleted');
    }
}
