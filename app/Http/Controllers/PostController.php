<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Index Show All Posts
     *
     * @return string|array
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString(),
        ]);
    }

    /**
     * Show a Post
     *
     * @param Post $post
     * @return string|array
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
