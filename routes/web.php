<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => redirect('/posts'));

Route::get('/posts', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('/posts/{post:slug}', function (Post $post) { // Post::where('slug', $post)->finfOrFail();

    return view('post', [
        'post' => $post
    ]);
});

Route::get('categories/{catagory}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts
    ]);
});
