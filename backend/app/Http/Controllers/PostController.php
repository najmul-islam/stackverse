<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with('category')->latest()->take(4)->get();

        if ($request->has('search')) {
            $search = $request->input('search');
            $posts->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        if ($request->wantsJson()) {
            return response()->json($posts);
        }
        return view('home', compact('posts'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'category', 'tags', 'comments']);
        return response()->json($post);
    }
}
