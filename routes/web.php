<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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

Route::get('/posts', function () {

    $files = File::files(resource_path("posts"));

    $posts = [];


    foreach ($files as $file) {
        $document = YamlFrontMatter::parseFile($file);

        $posts[] = new Post(
            $document->matter('title'),
            $document->matter('excerpt'),
            $document->matter('date'),
            $document->body(),
        );
    }

    return view('posts', [
        'posts' => $posts
    ]);
});

Route::get('/posts/{post}', function ($post) {
    return view('post', [
        'post' => Post::find($post)
    ]);
})->where('post', '[A-z_\-]+');
