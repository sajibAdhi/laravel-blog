<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{

    public static function all()
    {
        $files =  File::files(resource_path("posts/"));

        return array_map(function ($file) {
            return $file->getContents();
        }, $files);
    }

    /**
     * find
     *
     * @param mixed $post
     *
     * @return void
     */
    public static function find($post)
    {
        if (!file_exists($path = resource_path("posts/{$post}.html"))) {
            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.{$post}", 1200, fn () => file_get_contents($path));
    }
}
